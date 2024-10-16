<?php

namespace Drupal\custom_vbo_actions\Plugin\Action;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\PluginFormInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\Session\AccountInterface;
use Drupal\views_bulk_operations\Action\ViewsBulkOperationsActionBase;
use Drupal\views_bulk_operations\Action\ViewsBulkOperationsPreconfigurationInterface;

use Drupal\Component\Utility\Tags;

/**
 * The sketch of an example action for Drupal Commerce products: add some product tags. 
 * 
 * NOTE: Specific implementation is ILB. Here, only the form is implemented. :)
 *
 * Note: If type is left empty, action will be selectable for all entity types.
 *
 * The api_version annotation parameter specifies the behaviour of displayed
 * messages: anything other than "1" displays counts of exactly what's returned
 * by the action execute() and executeMultiple() method.
 *
 * @Action(
 *   id = "custom_vbo_actions_commerce_product_tags",
 *   label = @Translation("Update commerce product tags"),
 *   type = "commerce_product",
 *   confirm = TRUE,
 *   api_version = "1",
 * )
 */
class CustomVboActionsCommerceProductTags extends ViewsBulkOperationsActionBase implements ViewsBulkOperationsPreconfigurationInterface, PluginFormInterface {

  /**
   * {@inheritdoc}
   */
  public function execute($entity = NULL) {
    /*
     * All config resides in $this->configuration.
     * Passed view rows will be available in $this->context.
     * Data about the view used to select results and optionally
     * the batch context are available in $this->context or externally
     * through the public getContext() method.
     * The entire ViewExecutable object  with selected result
     * rows is available in $this->view or externally through
     * the public getView() method.
     */


    // Do some processing..
    // ...

    ksm($this->configuration['product_tags']);

    if ( !empty($this->configuration['product_tags']) ) {
      $product_tags = Tags::explode( $this->configuration['product_tags'] ) ;
      foreach ($product_tags as $ptag) {

        ksm($entity);
        ksm($ptag);
        
 
      }
  
  
    }
    
    $this->messenger()->addMessage($entity->label() . ' - ' . $entity->language()->getId() . ' - ' . $entity->id());
    return $this->t('Update commerce product tags (configuration: @configuration)', [
      '@configuration' => Markup::create(\print_r($this->configuration, TRUE)),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function buildPreConfigurationForm(array $form, array $values, FormStateInterface $form_state): array {
    $form['example_preconfig_setting'] = [
      '#title' => $this->t('Example setting'),
      '#type' => 'textfield',
      '#default_value' => $values['example_preconfig_setting'] ?? '',
    ];
    return $form;
  }

  /**
   * Configuration form builder.
   *
   * If this method has implementation, the action is
   * considered to be configurable.
   *
   * @param array $form
   *   Form array.
   * @param \Drupal\custom_admin\Plugin\Action\Drupal\Core\Form\FormStateInterface $form_state
   *   The form state object.
   *
   * @return array
   *   The configuration form.
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array {

    $form['product_tags'] = [
      '#title' => $this->t('Product tags'),
      '#type' => 'textarea',
      '#description' => $this->t('The product tags. Use comma-separated list. Example: funny, bungee jumping, "Company, Inc."'),
      '#default_value' => !empty($this->configuration['product_tags']) ? Tags::implode($this->configuration['product_tags']) : '',
    ];

    return $form;
  }

  /**
   * Submit handler for the action configuration form.
   *
   * If not implemented, the cleaned form values will be
   * passed directly to the action $configuration parameter.
   *
   * @param array $form
   *   Form array.
   * @param \Drupal\custom_admin\Plugin\Action\Drupal\Core\Form\FormStateInterface $form_state
   *   The form state object.
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state): void {
    // This is not required here, when this method is not defined,
    // form values are assigned to the action configuration by default.
    // This function is a must only when user input processing is needed.
    $this->configuration['product_tags'] = $form_state->getValue('product_tags');
  }

  /**
   * {@inheritdoc}
   */
  public function access($object, ?AccountInterface $account = NULL, $return_as_object = FALSE) {
    // If certain fields are updated, access should be checked against them
    // as well. @see Drupal\Core\Field\FieldUpdateActionBase::access().
    return $object->access('update', $account, $return_as_object);
  }

}
