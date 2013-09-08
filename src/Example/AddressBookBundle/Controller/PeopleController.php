<?php
/**
 * Controller for the example address book, with basic CRUD functionality
 * 
 * @author LukeMannering
 */
namespace Example\AddressBookBundle\Controller;

use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Form\FormBuilder;
use Example\AddressBookBundle\Entity\People;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PeopleController extends Controller
{
    /**
     * Renders the list of all address book entries
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(){
        
        // Get all address book entries ordered by last name
        $em = $this->getDoctrine()->getManager();
        $people = $em->getRepository('ExampleAddressBookBundle:People')
            ->findAll();
                       
        return $this->render('ExampleAddressBookBundle:People:list.html.twig', array('people' => $people));
    }

    /**
     * Inserts new address book entries, using the form template
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request){
        
        // Create new People object and use it to get a FormBuilder
        $person = new People();
        $form   = $this->getFormObject($person);
    
        // If form was submitted, bind request object and validate
        if ($request->getMethod() == 'POST'){
            
            $form->bind($request);
    
            if ($form->isValid()){
                
                // Persist to DB using Doctrine                
                $em = $this->getDoctrine()->getManager();
                $em->persist($person);
                $em->flush();
    
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    $person->getFirstName() . ' ' . $person->getLastName() . 'was created successfully.'
                );
            }
        }
            
        // Insert a form view into the template, and set correct form action
        return $this->render('ExampleAddressBookBundle:People:form.html.twig', array (
            'form'        => $form->createView(),
            'formAction'  => $this->generateUrl('addressbook_create')
        ));
    }
    

    /**
     * Produce form, and handle form submission
     * 
     * @param Request $request
     * @param integer $id : Primary key from People entity
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id){
        
        // Retrieve address book entry by id
        $person = $this->getDoctrine()
            ->getRepository('ExampleAddressBookBundle:People')
            ->find($id);
        
        if (!$person) {
            throw $this->createNotFoundException(
                'No address book entry found for id '.$id
            );
        }

        // Use the person objes to get a FormBuilder
        $form = $this->getFormObject($person);
    
        // If form was submitted, bind request object and validate
        if ($request->getMethod() == 'POST'){
            
            $form->bind($request);
    
            if ($form->isValid()){
                
                // Persist to DB using Doctrine                
                $em = $this->getDoctrine()->getManager();
                $em->persist($person);
                $em->flush();
    
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Changes saved successfully'
                );
            }
        }
        
        // Insert a form view into the template, and set correct form action
        return $this->render('ExampleAddressBookBundle:People:form.html.twig', array (
            'form'=> $form->createView(),
            'formAction'   => $this->generateUrl('addressbook_update',array('id' => $id))
        ));
    }
    
    /**
     * Deletes an address book entry by id
     * 
     * @param Request $request
     * @param integer $id : Primary key from People entity
     */
    public function deleteAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
       
        $person = $this->getDoctrine()
            ->getRepository('ExampleAddressBookBundle:People')
            ->find($id);
        
        $em->remove($person);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add(
            'notice',
            $person->getFirstName() . ' ' . $person->getLastName() . 'has been deleted.'
        );
        
        return $this->redirect($this->generateUrl('addressbook_list'));
    }
    
    /**
     * Wrapper for FormBuilder creatinon, that's used for the create and update actions.
     * 
     * @param People $person
     * @return FormBuilder $form
     */
    public function getFormObject(People $person){
        
        $form =  $this->createFormBuilder($person)
            ->add('firstName', 'text', array(
                    'required' => true,
                    'max_length'=> 100
            ))
            ->add('lastName', 'text', array(
                    'required' => true,
                    'max_length'=> 100
            ))
            ->add('addressLine1', 'text', array(
                    'required' => true,
                    'max_length'=> 100
            ))
            ->add('addressLine2', 'text', array(
                    'required' => false,
                    'max_length'=> 100
            ))
            ->add('city', 'text', array(
                    'required' => true,
                    'max_length'=> 100
            ))
            ->add('postcode', 'text', array(
                    'required' => true,
                    'max_length'=> 10
            ))
            ->add('telephoneHome', 'text', array(
                    'required' => false,
                    'max_length'=> 100
            ))
            ->add('telephoneMobile', 'text', array(
                    'required' => false,
                    'max_length'=> 100
            ))
            ->getForm();
            
        return $form;
    }
    
}