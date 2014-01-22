<?php 
  $sub_total = 0;
?>

<?php if (isset($element['#title'])): ?>
  <label><?php print $element['#title']; ?></label>
<?php endif; ?>
<table class="uc-quantity-grid-table">
  <thead>
    <tr>
      <th class="uc-quantity-grid-th-name">Name</th>
      <th class="uc-quantity-grid-th-unitprice">Unit Price</th>
      <th class="uc-quantity-grid-th-quantity">Quantity</th>
      <th class="uc-quantity-grid-th-price">Total</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach (element_children($element) as $oid) {
      $display = $element['#grid'][$oid];
      $price = money_format('%.2n',$element[$oid]['#attributes']['unit_price']);
      $num_of_days = isset($element[$oid]['#default_value']) ? $element[$oid]['#default_value'] : 0;
      $sub_total += $price * $num_of_days;
      $element[$oid]['#title'] = '';
      unset($element[$oid]['#attributes']['unit_price']);
  ?>
  <tr class="option-<?php echo $oid ?>">
    <td class="uc-quantity-grid-name"><?php echo strpos($display,',') ? substr($display, 0, strpos($display,',')) : $display; ?></td>
    <td class="uc-quantity-grid-unitprice">$<?php echo money_format('%.2n',$price); ?></td>
    <td class="uc-quantity-grid-quantity"><?php echo drupal_render($element[$oid]); ?></td>
    <td class="uc-quantity-grid-price">$<?php echo money_format('%.2n', $price * $num_of_days); ?></span>
  </tr>
  <?php } ?>
  </tbody>
  <tfoot><tr class="uc-quantity-grid-subtotal"><td colspan="2"></td><td>Sub Total:</td><td> $<?php echo money_format('%.2n', $sub_total); ?></td></tr></tfoot>
</table>