<?php

namespace Secl\SocialsBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SeclTwigSocialLinks
 *
 * PHP version 5
 *
 *
 * @category  Secl\SocialsBundle\Twig\Extension
 * @package   Secl\SocialsBundle\Twig\Extension
 * @author    HSN <info@secl.com.ua>
 * @copyright ${YEAR} The SECL Group
 * @license   SECL Group PHP License
 * @link      http://secl.com.ua
 */
class SeclTwigSocialLinks extends \Twig_Extension
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'secl_social_links';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'socialLinks' => new \Twig_Function_Method($this, 'getSocialLinks',
                array('is_safe' => array('html'))),
            'socialLink' => new \Twig_Function_Method($this, 'getSocialLink',
                array('is_safe' => array('html'))),
        );
    }

    /**
     * @param array $parameters
     *
     * @return mixed
     */
    public function getSocialLinks($parameters = array())
    {
        $networks = array(
            'facebook',
            'twitter',
            'googleplus',
            'linkedin',
            'tumblr',
            'pinterest',
            'youtube',
            'instagram',
        );
        foreach ($networks as $network) {
            // no parameters were defined, keeps default values
            if (!array_key_exists($network, $parameters)) {
                $render_parameters[$network] = array();
                // parameters are defined, overrides default values
            } else {
                if (is_array($parameters[$network])) {
                    $render_parameters[$network] = $parameters[$network];
                    // the button is not displayed 
                } else {
                    $render_parameters[$network] = false;
                }
            }
        }

        // get the helper service and display the template
        return $this->container->get('secl.socialLinksHelper')
            ->socialLinks($render_parameters);
    }

    // https://developers.facebook.com/docs/reference/plugins/like/ 
    /**
     * @param       $network
     * @param array $parameters
     *
     * @return bool
     */
    public function getSocialLink($network, $parameters = array())
    {
        // default values, you can override the values by setting them
        $otherParameters = $this->container->hasParameter('links.' . $network)
            ? $this->container->getParameter('links.' . $network) : array();
        $parameters = $parameters + $otherParameters;

        if (!array_key_exists('network', $parameters)) {
            $parameters = $parameters + array('network' => $network);
        }
        if (!array_key_exists('theme', $parameters)) {
            $parameters = $parameters
                + array('theme' => $this->container->getParameter('social.theme'));
        }

        return !empty($parameters) && array_key_exists('url', $parameters)
            ? $this->container->get('secl.socialLinksHelper')
                ->socialLink($parameters) : false;
    }
}
