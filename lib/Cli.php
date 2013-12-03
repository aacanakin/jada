<?php
class Cli
{
	static public function extract($gz_file, $file, $append = false)
	{
		if ($append) {

			exec("gzip -dc {$gz_file} >> {$file}");

		} else {

			exec("gzip -dc {$gz_file} > {$file}");
		}
		
		return (filesize($file) > 0);
	}

	static public function remove($path)
	{
		exec ("rm -rf {$path}");

		return (file_exists($path)) ? false : true;
	}

	static public function rename($path, $name, $new_name)
	{
		exec ("mv {$path}/$name {$path}/{$new_name}");
	}

	static public function move($path, $new_path)
	{
		exec ("mv {$path} {$new_path}");
	}

	static public function countLines($path)
	{
		if (file_exists($path)) {
			exec ("wc -l {$path}", $return);
			return $return[0];
			// pe($return);
		} else {
			return 0;
		}
	}

	static public function ls($path, $ignore_dots = true)
	{
		$files = array();

		if (is_dir($path)) {
			if ($handle = opendir($path)) {

			    while (false !== ($entry = readdir($handle))) {
			    	$entry = trim($entry);
			    	if (! $ignore_dots) {
			    		$files[] = $entry;
			    	} else {
			    		if ($entry != '.' && $entry != '..') {
			    			$files[] = $entry;
			    		}
			    	}
			    }

			    closedir($handle);
			} else {
				return null;
			}

		} else {
			if (file_exists($path)) {
				$files[] = $path;
			} else {
				return null;
			}
		}

		return $files;
	}
}
