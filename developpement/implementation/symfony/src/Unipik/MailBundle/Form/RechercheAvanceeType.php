<?php
/**
 * Created by PhpStorm.
 * User: jpain01
 * Date: 22/09/16
 * Time: 10:36
 *
 * PHP version 5
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\MailBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
/**
 * Class RechercheAvanceeType
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */


class RechercheAvanceeType extends AbstractType {
    private $entityManager;

    /**
     *
     * @param ObjectManager $entityManager Le manager
     *
     * @return object
     */
    public function __construct(ObjectManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Build a form
     *
     * @param FormBuilderInterface $builder Le builder
     * @param array                $options Les options
     *
     * @return object
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add(
                'date', CheckboxType::class, array(
                    'label'    => 'Toutes',
                    'required' => false,
                )
            )
            ->add(
                'start', DateType::class, array(
                    'widget' => 'single_text',

                    // do not render as type="date", to avoid HTML5 date pickers
                    'html5' => false,

                    // add a class that can be selected in JavaScript
                    'attr' => ['class' => 'js-datepicker'],
                    'format' => 'dd-MM-yyyy',
                    'required' => false,
                    'label' => false
                )
            )
            ->add(
                'end', DateType::class, array(
                    'widget' => 'single_text',

                    // do not render as type="date", to avoid HTML5 date pickers
                    'html5' => false,

                    // add a class that can be selected in JavaScript
                    'attr' => ['class' => 'js-datepicker'],
                    'format' => 'dd-MM-yyyy',
                    'required' => false,
                    'label' => false
                )
            );

    }
}
