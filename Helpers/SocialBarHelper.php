<?php

namespace Secl\SocialsBundle\Helpers;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class SocialBarHelper
 *
 * PHP version 5
 *
 *
 * @category  Secl\SocialsBundle\Helpers
 * @package   Secl\SocialsBundle\Helpers
 * @author    HSN <info@secl.com.ua>
 * @copyright ${YEAR} The SECL Group
 * @license   SECL Group PHP License
 * @link      http://secl.com.ua
 */
class SocialBarHelper extends Helper
{
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * SocialBarHelper constructor.
     *
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }


    /**
     * @param array $parameters
     *
     * @return string
     */
    public function socialButtons($parameters)
    {
        return $this->templating->render(
            'SeclSocialsBundle:Buttons:socialButtons.html.twig',
            $parameters
        );
    }

    /**
     * @param $network
     * @param $parameters
     *
     * @return string
     */
    private function socialButton($network, $parameters)
    {
        return $this->templating->render(
            'SeclSocialsBundle:Buttons:' . $network
            . 'Button.html.twig', $parameters
        );
    }

    /**
     * @param array $parameters
     *
     * @return string
     */
    public function facebookButton($parameters)
    {
        return $this->socialButton('facebook', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return string
     */
    public function twitterButton($parameters)
    {
        return $this->socialButton('twitter', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return string
     */
    public function googlePlusButton($parameters)
    {
        return $this->socialButton('googleplus', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return string
     */
    public function linkedinButton($parameters)
    {
        return $this->socialButton('linkedin', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return string
     */
    public function pinterestButton($parameters)
    {
        return $this->socialButton('pinterest', $parameters);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'socialButtons';
    }
}
