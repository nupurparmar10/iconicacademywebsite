<?php
	$db = new PDO("mysql:host=127.0.0.1;dbname=iconic_academy_website;charset=utf8","root","");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$home=$about=$department=$test=$package=$doctor=$contact=false;
	/**
	 * Sanitize and validate input values for use across the application.
	 *
	 * @param mixed  $value   The raw input value.
	 * @param string $type    Expected input type: int|float|email|url|alnum|alpha|string|bool.
	 * @param array  $options Optional settings like max_length, min, max, pattern.
	 * @return mixed|null     Sanitized value, or null when validation fails.
	*/
	function sanitize_input($value, $type = 'string', array $options = [])
	{
		if (is_array($value)) {
			$result = [];
			foreach ($value as $key => $item) {
				$result[$key] = sanitize_input($item, $type, $options);
			}
			return $result;
		}

		if ($value === null) {
			return null;
		}

		$value = trim((string)$value);

		switch ($type) {
			case 'int':
				$opts = ['options' => ['min_range' => $options['min'] ?? PHP_INT_MIN, 'max_range' => $options['max'] ?? PHP_INT_MAX]];
				$int = filter_var($value, FILTER_VALIDATE_INT, $opts);
				return ($int === false) ? null : $int;

			case 'float':
				$float = filter_var($value, FILTER_VALIDATE_FLOAT);
				return ($float === false) ? null : $float;

			case 'bool':
				$bool = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
				return $bool;

			case 'email':
				$email = filter_var($value, FILTER_VALIDATE_EMAIL);
				return ($email === false) ? null : $email;

			case 'url':
				$url = filter_var($value, FILTER_VALIDATE_URL);
				return ($url === false) ? null : $url;

			case 'alnum':
				if (preg_match('/^[a-zA-Z0-9]+$/', $value)) {
					return $value;
				}
				return null;

			case 'alpha':
				if (preg_match('/^[a-zA-Z]+$/', $value)) {
					return $value;
				}
				return null;

			case 'string':
			default:
			$forbid_tags = ['script', 'a'];
			if (isset($options['forbid_tags']) && is_array($options['forbid_tags'])) {
				$forbid_tags = array_unique(array_merge($forbid_tags, $options['forbid_tags']));
			}

			foreach ($forbid_tags as $tag) {

					$tag = preg_quote($tag, '/');

					// Remove complete tag with content
					$value = preg_replace(
						'/<\s*' . $tag . '\b[^>]*>.*?<\s*\/\s*' . $tag . '\s*>/is',
						'',
						$value
					);

					// Remove self-closing or standalone tags
					$value = preg_replace(
						'/<\s*\/?\s*' . $tag . '\b[^>]*>/i',
						'',
						$value
					);
				}

			// Custom regex validation
			if (isset($options['pattern']) && !preg_match($options['pattern'], $value)) {
				return null;
			}

			// Max length check
			if (isset($options['max_length']) && mb_strlen($value, 'UTF-8') > $options['max_length']) {
				return null;
			}

			// Min length check
			if (isset($options['min_length']) && mb_strlen($value, 'UTF-8') < $options['min_length']) {
				return null;
			}

			return trim($value);
		}
	}

	/**
	 * Retrieve and sanitize a request value from GET, POST or REQUEST.
	 *
	 * @param string $key     Request key.
	 * @param string $type    Expected type.
	 * @param mixed  $default Default value when the key is missing or invalid.
	 * @param string $source  "get", "post", or "request".
	 * @param array  $options Optional validation options.
	 * @return mixed
	 */
	function get_input(string $key, string $type = 'string', $default = null, string $source = 'request', array $options = [])
	{
		switch (strtolower($source)) {
			case 'get':
				$value = $_GET[$key] ?? null;
				break;
			case 'post':
				$value = $_POST[$key] ?? null;
				break;
			default:
				$value = $_REQUEST[$key] ?? null;
		}

		$sanitized = sanitize_input($value, $type, $options);
		return ($sanitized === null) ? $default : $sanitized;
	}

	/**
	 * Sanitize request globals so older pages that still use $_REQUEST directly
	 * also get script and anchor tags removed.
	 */
	function sanitize_request_globals()
	{
		foreach (array_keys($_GET) as $key) {
			$_GET[$key] = get_input((string)$key, 'string', null, 'get');
		}

		foreach (array_keys($_POST) as $key) {
			$_POST[$key] = get_input((string)$key, 'string', null, 'post');
		}

		foreach (array_keys($_REQUEST) as $key) {
			$_REQUEST[$key] = get_input((string)$key, 'string', null, 'request');
		}
	}

	function delete_uploaded_file($path)
	{
		if ($path === '') {
			return;
		}

		$fullPath = realpath(__DIR__ . '/' . $path);
		$basePath = realpath(__DIR__ . '/assets/images');

		if ($fullPath && $basePath && strpos($fullPath, $basePath . DIRECTORY_SEPARATOR) === 0 && is_file($fullPath)) {
			unlink($fullPath);
		}
	}

	function uploaded_image_info($file)
	{
		if (!isset($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
			return null;
		}

		if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
			return false;
		}

		$extension = strtolower(pathinfo($file['name'] ?? '', PATHINFO_EXTENSION));
		if (!in_array($extension, ['jpg', 'jpeg', 'png'], true)) {
			return false;
		}

		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$mimeType = $finfo->file($file['tmp_name']);
		$allowedMimeTypes = [
			'image/jpeg' => 'jpg',
			'image/png' => 'png',
		];

		if (!isset($allowedMimeTypes[$mimeType]) || getimagesize($file['tmp_name']) === false) {
			return false;
		}

		return [
			'extension' => $allowedMimeTypes[$mimeType],
			'mime' => $mimeType,
		];
	}

	function upload_pic_image($file, $uploadPath, array $options = [])
	{
		$imageInfo = uploaded_image_info($file);

		if ($imageInfo === null) {
			return null;
		}

		if ($imageInfo === false) {
			return '';
		}

		$uploadPath = rtrim($uploadPath, '/') . '/';
		$uploadDir = __DIR__ . '/' . $uploadPath;
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0755, true);
		}

		$originalName = pathinfo($file['name'], PATHINFO_FILENAME);
		$safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName);
		$safeName = trim($safeName, '_');
		if ($safeName === '') {
			$safeName = 'image';
		}

		$fileName = $options['filename'] ?? ($safeName . '.' . $imageInfo['extension']);
		if (pathinfo($fileName, PATHINFO_EXTENSION) === '') {
			$fileName .= '.' . $imageInfo['extension'];
		}

		$destination = $uploadDir . $fileName;
		$path = $uploadPath . $fileName;
		$width = $options['width'] ?? null;
		$height = $options['height'] ?? null;

		if ($width === null || $height === null) {
			return move_uploaded_file($file['tmp_name'], $destination) ? $path : '';
		}

		$source = ($imageInfo['mime'] === 'image/jpeg')
			? imagecreatefromjpeg($file['tmp_name'])
			: imagecreatefrompng($file['tmp_name']);

		if (!$source) {
			return '';
		}

		list($originalWidth, $originalHeight) = getimagesize($file['tmp_name']);
		$image = imagecreatetruecolor((int)$width, (int)$height);

		if ($imageInfo['mime'] === 'image/png') {
			imagealphablending($image, false);
			imagesavealpha($image, true);
		}

		imagecopyresampled($image, $source, 0, 0, 0, 0, (int)$width, (int)$height, $originalWidth, $originalHeight);

		$saved = ($imageInfo['mime'] === 'image/jpeg')
			? imagejpeg($image, $destination, $options['quality'] ?? 100)
			: imagepng($image, $destination);

		imagedestroy($source);
		imagedestroy($image);

		return $saved ? $path : '';
	}

	sanitize_request_globals();


	if (empty($_SESSION['csrf_token'])) 
	{
		$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	}
?>
