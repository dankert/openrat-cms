<?php


namespace cms\generator\target;


use util\ClassUtils;
use util\exception\PublisherException;

class TargetFactory
{

	/**
	 * Creates a target for publishing files.
	 *
	 * @param string $url URL
	 * @return Target
	 * @throws PublisherException if no target could be created
	 */
	public static function getTargetForUrl( $url ) {

		$scheme = parse_url( $url,PHP_URL_SCHEME );

		/** @var Target $target */
		$target = null;

		switch( $scheme ) {

			case '':
			case 'file':
			case 'local':
				$target = new Local($url);
				break;

			case 'dav':
				$target = new Dav($url);
				break;

			case 'ftp':
				$target = new Ftp($url);
				break;

			case 'ftps':
				$target = new Ftps($url);
				break;

			case 'scp':
				$target = new Scp($url);
				break;

			case 'sftp':
				$target = new SFtp($url);
				break;

			default:
				throw new PublisherException('The scheme "'.$scheme.'" is not supported.' );
		}

		if   ( ! $target::isAvailable() )
			throw new PublisherException(ClassUtils::getSimpleClassName($target).' is not available.' );

		return $target;
	}
}