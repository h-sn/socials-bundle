<?php

namespace Secl\SocialsBundle\Helpers;

use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Templating\Helper\Helper;

/**
 * Class SocialLinksHelper
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
class SocialLinksHelper extends Helper
{
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * SocialLinksHelper constructor.
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
    public function socialLinks($parameters)
    {
        return $this->templating->render(
            'SeclSocialsBundle:Links:socialLinks.html.twig',
            $parameters
        );
    }

    /**
     * @param array $parameters
     *
     * @return string
     */
    public function socialLink($parameters)
    {
        return $this->templating->render(
            'SeclSocialsBundle:Links:socialLink.html.twig',
            $parameters
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'socialLinks';
    }
}
