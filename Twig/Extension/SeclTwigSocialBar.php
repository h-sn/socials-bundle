<?php

namespace Secl\SocialsBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SeclTwigSocialBar
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
class SeclTwigSocialBar extends \Twig_Extension
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $networks;

    /**
     * Constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct($container)
    {
        $this->container = $container;
        $this->networks = array(
            'facebook',
            'twitter',
            'googleplus',
            'linkedin',
            'tumblr',
            'pinterest',
            'youtube',
            'instagram',
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'secl_social_bar';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'socialButtons' => new \Twig_Function_Method($this,
                'getSocialButtons', array('is_safe' => array('html'))),
            'facebookButton' => new \Twig_Function_Method($this,
                'getFacebookLikeButton', array('is_safe' => array('html'))),
            'twitterButton' => new \Twig_Function_Method($this,
                'getTwitterButton', array('is_safe' => array('html'))),
            'googleplusButton' => new \Twig_Function_Method($this,
                'getGoogleplusButton', array('is_safe' => array('html'))),
            'linkedinButton' => new \Twig_Function_Method($this,
                'getLinkedinButton', array('is_safe' => array('html'))),
            'pinterestButton' => new \Twig_Function_Method($this,
                'getPinterestButton', array('is_safe' => array('html'))),
        );
    }

    /**
     * @param array $parameters
     *
     * @return mixed
     */
    public function getSocialButtons($parameters = array())
    {

        foreach ($this->networks as $network) {
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
        return $this->container->get('secl.socialBarHelper')
            ->socialButtons($render_parameters);
    }

    // https://developers.facebook.com/docs/reference/plugins/like/ 
    /**
     * @param array $parameters
     *
     * @return mixed
     */
    public function getFacebookLikeButton($parameters = array())
    {
        // default values, you can override the values by setting them
        return $this->getButton('facebook', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return mixed
     */
    public function getTwitterButton($parameters = array())
    {
        return $this->getButton('twitter', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return mixed
     */
    public function getGoogleplusButton($parameters = array())
    {
        return $this->getButton('googleplus', $parameters);

    }

    /**
     * @param array $parameters
     *
     * @return mixed
     */
    public function getLinkedinButton($parameters = array())
    {
        return $this->getButton('linkedin', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return mixed
     */
    public function getPinterestButton($parameters = array())
    {
        return $this->getButton('pinterest', $parameters);
    }

    /**
     * @param       $network
     * @param array $parameters
     *
     * @return mixed
     */
    private function getButton($network, $parameters = array())
    {
        $parameters = $parameters + $this->container->getParameter('buttons.'
                . $network);
        $Button = $network . 'Button';

        return $this->container->get('secl.socialBarHelper')
            ->$Button($parameters);
    }

    /**
     * @param array $networks
     *
     * @return $this
     */
    public function setNetworks($networks)
    {
        $this->networks = $networks;

        return $this;
    }
}
