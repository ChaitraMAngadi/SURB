<!DOCTYPE html>
<html>
<head>
  <title>Cashfree - Signature Generator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body onload="document.frm1.submit()">
<form action="<?php echo $url; ?>" name="frm1" method="post">
      <p>Please wait.......</p>
      <input type="hidden" name="signature" value='<?php echo $signature; ?>'/>
      <input type="hidden" name="orderNote" value='<?php echo $post_data['orderNote']; ?>'/>
      <input type="hidden" name="orderCurrency" value='<?php echo $post_data['orderCurrency']; ?>'/>
      <input type="hidden" name="customerName" value='<?php echo $post_data['customerName']; ?>'/>
      <input type="hidden" name="customerEmail" value='<?php echo $post_data['customerEmail']; ?>'/>
      <input type="hidden" name="customerPhone" value='<?php echo $post_data['customerPhone']; ?>'/>
      <input type="hidden" name="orderAmount" value='<?php echo $post_data['orderAmount']; ?>'/>
      <input type ="hidden" name="notifyUrl" value='<?php echo $post_data['notifyUrl']; ?>'/>
      <input type ="hidden" name="returnUrl" value='<?php echo $post_data['returnUrl']; ?>'/>
      <input type="hidden" name="appId" value='<?php echo $post_data['appId']; ?>'/>
      <input type="hidden" name="orderId" value='<?php echo $post_data['orderId']; ?>'/>
      <input type ="hidden" name="coupon_discount" value='<?php echo $post_data['coupon_discount']; ?>'/>
      <input type="hidden" name="total_price" value='<?php echo $post_data['total_price']; ?>'/>
      <input type="hidden" name="coupon_id" value='<?php echo $post_data['coupon_id']; ?>'/>
  </form>
    </body>
</html>