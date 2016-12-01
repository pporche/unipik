<?php
/**
 * Created by PhpStorm.
 * User: Kafui
 * Date: 13/09/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class FlashListener
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class FlashListener implements EventSubscriberInterface
{
    private static $successMessages = array(
        FOSUserEvents::CHANGE_PASSWORD_COMPLETED => 'change_password.flash.success',
        FOSUserEvents::GROUP_CREATE_COMPLETED => 'group.flash.created',
        FOSUserEvents::GROUP_DELETE_COMPLETED => 'group.flash.deleted',
        FOSUserEvents::GROUP_EDIT_COMPLETED => 'group.flash.updated',
        FOSUserEvents::PROFILE_EDIT_COMPLETED => 'profile.flash.updated',
        FOSUserEvents::REGISTRATION_COMPLETED => 'registration.flash.user_created',
        FOSUserEvents::RESETTING_RESET_COMPLETED => 'resetting.flash.success',
        FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'Connexion réussie.',
        'security.interactive_login' => 'Connexion réussie.'
    );

    private $session;
    private $translator;

    /**
     * FlashListener constructor.
     *
     * @param Session             $session    La session
     * @param TranslatorInterface $translator Le translator
     *
     * @return object
     */
    public function __construct(Session $session, TranslatorInterface $translator)
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    /**
     * Get subscribed events
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::CHANGE_PASSWORD_COMPLETED => 'addSuccessFlash',
            FOSUserEvents::GROUP_CREATE_COMPLETED => 'addSuccessFlash',
            FOSUserEvents::GROUP_DELETE_COMPLETED => 'addSuccessFlash',
            FOSUserEvents::GROUP_EDIT_COMPLETED => 'addSuccessFlash',
            FOSUserEvents::PROFILE_EDIT_COMPLETED => 'addSuccessFlash',
            FOSUserEvents::REGISTRATION_COMPLETED => 'addSuccessFlash',
            FOSUserEvents::RESETTING_RESET_COMPLETED => 'addSuccessFlash',
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'addSuccessFlash',
            'security.interactive_login' => 'addSuccessFlash'
        );
    }

    /**
     * Add a success Flash
     *
     * @param Event $event     L'event
     * @param null  $eventName Le nom de l'event
     *
     * @return object
     */
    public function addSuccessFlash(Event $event, $eventName = null)
    {
        // BC for SF < 2.4
        if (null === $eventName) {
            $eventName = $event->getName();
        }

        if (!isset(static::$successMessages[$eventName])) {
            throw new \InvalidArgumentException('This event does not correspond to a known flash message');
        }

        $this->session->getFlashBag()
            ->add(
                'notice', array(
                'title'=>'Félicitations !',
                'message'=> $this->_trans(static::$successMessages[$eventName]),
                'alert'=>'success'
                )
            );

    }

    /**
     * Translate
     *
     * @param array $message Les messages
     * @param array $params  Les parametres
     *
     * @return string
     */
    private function _trans($message, array $params = array())
    {
        return $this->translator->trans($message, $params, 'FOSUserBundle');
    }
}
