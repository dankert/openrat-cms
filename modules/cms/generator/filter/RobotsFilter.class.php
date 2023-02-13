<?php


namespace cms\generator\filter;


use util\YAML;

class RobotsFilter extends AbstractFilter
{
	public function filter( $value )
	{
		$output = '';
		$robots = YAML::parse( $value );

		if   ( @$robots['allowedAgents'] )
			foreach ( $robots['allowedAgents'] as $allowedAgent)
				$output .= 'User-Agent: '.$allowedAgent."\n".'Allow: /'."\n";

		if   ( @$robots['disallowedAgents'] )
			foreach ( $robots['disallowedAgents'] as $disallowedAgent)
				$output .= 'User-Agent: '.$disallowedAgent."\n".'Disallow: /'."\n";

		if   ( @$robots['agents'] )
			foreach ( $robots['agents'] as $agent) {
				$output .= 'User-Agent: '.@$agent['name']."\n";
				if   ( @$agent['allow'] )
					$output .= 'Allow: '.@$agent['allow']."\n";
				if   ( @$agent['disallow'] )
					$output .= 'Disallow: '.@$agent['disallow']."\n";
			}

		if   ( @$robots['sitemap'] )
			$output .= 'Sitemap: '.@$robots['sitemap']."\n";

		if   ( @$robots['delay'] )
			$output .= 'Crawl-delay: '.@$robots['delay']."\n";

		return $output;
	}
}