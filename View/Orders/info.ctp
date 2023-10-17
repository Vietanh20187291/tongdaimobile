<!-- start orders/info.ctp -->
<article class="box_content order col-xs-12">
	<header class="title">
		<h1><?php echo __('Thông tin giao hàng',true)?></h1>
	</header>

	<div class="des row">
		<?php echo $this->Form->create('Order',array('inputDefaults'=>array('div'=>false,'label'=>false)));
			echo $this->Form->input('csrfToken',array('type'=>'hidden','id'=>'csrfToken', 'value'=>$csrfToken));
			?>
		<div class="form col-xs-12 col-sm-6 col-md-6">
			<h2 class="text-uppercase mb-3"><?php echo __('Thanh toán')?></h2>
			<div class="des clearfix">
				<div class="form-group order_payment">
					<div class="radio_item">
						<input type="radio" name="data[Order][method_payment]" id="OrderMethodPayment2" value="Chuyển khoản qua ngân hàng" class="mr-2" required="required" checked="checked">
						<label for="OrderMethodPayment2">Chuyển khoản qua ngân hàng</label>
						<label class="check" for="OrderMethodPayment2"><div class="inside"></div></label>
						<div id="bankinfo" class="">
							<?php
								if ( ! empty($a_config_info['bankinfo'])) {
									echo $a_config_info['bankinfo'];
									echo $this->Form->input('bank_info',array('type'=>'hidden','class'=>'form-control', 'value'=>$a_config_info['bankinfo']));
								}
							?>
						</div>
					</div>
					<div class="radio_item">
						<input type="radio" name="data[Order][method_payment]" id="OrderMethodPayment1" value="Thanh toán khi giao hàng" class="mr-2" required="required">
						<label for="OrderMethodPayment1">Thanh toán khi giao hàng</label>
						<label class="check" for="OrderMethodPayment1"><div class="inside"></div></label>
					</div>
					<!-- <div class="radio_item">
						<input type="radio" name="data[Order][method_payment]" id="OrderMethodPayment4" value="Thanh toán bằng Visa/Master/Amex/JCB Card" class="mr-2" required="required">
						<label for="OrderMethodPayment4">Thanh toán bằng Visa/Master/Amex/JCB Card</label>
						<label class="check" for="OrderMethodPayment4"><div class="inside"></div></label>
					</div> -->
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('name',__('Tên người nhận',true).'<span class="im">*</span>');
					echo $this->Form->input('name',array('class'=>'form-control'));
				?>
			</div>
			<div class="form-group">
				<?php
					echo $this->Form->label('phone',__('Điện thoại',true).'<span class="im">*</span>');
					echo $this->Form->input('phone',array('class'=>'form-control'))
				?>
			</div>
			<div class="form-group">
				<?php
					echo $this->Form->label('email',__('Email',true));
					echo $this->Form->input('email',array('class'=>'form-control'))
				?>
			</div>
			<div class="form-group">
				<?php
					echo $this->Form->label('address',__('Địa chỉ nhận hàng',true));
					echo $this->Form->input('address',array('class'=>'form-control'))
				?>
			</div>
			<div class="form-group">
				<?php
					echo $this->Form->label('message',__('Yêu cầu khác nếu bạn muốn',true));
					echo $this->Form->input('message',array('type'=>'textarea','class'=>'form-control'))
				?>
			</div>
			<div class="form-group hidden">
				<?php
					echo $this->Form->input('rate', array('value' => $a_currency_c['value']));
					echo $this->Form->input('unit_payment', array('value' => $a_currency_c['name']));
				?>
			</div>
		</div>

		<div class="order_info  col-xs-12 col-sm-6 col-md-6">
			<span class="title font-weight-bold"><?php echo __('Thông tin đơn hàng',true)?></span>
			<?php if(!empty($order_info_c)){?>
				<table class="table">
					<tr>
						<th><?php echo __('Sản phẩm',true)?></th>
						<th class="small center"><?php echo __('Giá',true)?></th>
						<th class="small center"><?php echo __('Màu sắc',true)?></th>
						<th class="small center"><?php echo __('Kích cỡ',true)?></th>
						<th class="small center"><?php echo __('Số lượng',true)?></th>
						<th class="small center"><?php echo __('Thành tiền',true)?></th>
					</tr>
					<?php foreach($order_info_c['detail'] as $val){
					$item = $val['Product'];
					?>
					<tr>
						<td>
						<?php
                            echo $this->OnewebVn->thumb('products/'.$item['image'],array('alt'=>$item['name'],'width'=>60,'height'=>60, 'zc' => 2, 'class'=>'img-responsive pull-left m-b-10'));
                            echo $this->Html->tag('p',$item['name'],array('class'=>'p_name pull-right'));?>
                        <div class="clear"></div>
                        <?php    if($item['quantity']>0) echo $this->Html->tag('p',__('Còn hàng',true),array('class'=>'text-success'));
							else echo $this->Html->tag('p',__('Hết hàng',true),array('class'=>'text-danger'));
							if(!empty($item['promotion'])) echo $this->Html->tag('p',__('Khuyến mãi',true).': '.$item['promotion'],array('class'=>'promotion'));
						?>
						</td>
						<td class="small">
						<?php
							if(!empty($item['price_new'])) {
								$price = $item['price_new'];
							}else{
								$price = $item['price'];
							}
							echo $this->Html->tag('span',number_format($price/$a_currency_c['value'],$a_currency_c['decimal'],$a_currency_c['sep1'],$a_currency_c['sep2']).' '.$a_currency_c['name'],array('class'=>'new font-weight-bold color-red'));
							echo '</br>';
							if(!empty($item['price_new'])){
								echo $this->Html->tag('del',number_format($item['price']/$a_currency_c['value'],$a_currency_c['decimal'],$a_currency_c['sep1'],$a_currency_c['sep2']).' '.$a_currency_c['name'],array('class'=>'font-weight-bold price_old'));
								if(!empty($item['discount'])) echo $this->Html->tag('p class="font-style-italic"',__('Giảm giá',true).': '.$item['discount'].'%',array('class'=>'discount'));
							}
						?>
						</td>
						<td class="center"><?php echo $item['color']?></td>
						<td class="center"><?php echo $item['size']?></td>
						<td class="center"><?php echo $item['qty']?></td>
						<td class="small price">
						<?php
							if($a_currency_c['location']=='first') echo $a_currency_c['name'].' ';
							echo number_format($price*$item['qty']/$a_currency_c['value'],$a_currency_c['decimal'],$a_currency_c['sep1'],$a_currency_c['sep2']);
							if($a_currency_c['location']=='last') echo ' '.$a_currency_c['name'];
						?>
						</td>
					</tr>
					<?php }?>
					<tr class="total">
						<td colspan="2"></td>
						<td align="right"><?php echo __('Tổng',true).': '?></td>
						<td colspan="4">
							<strong class="color-red">
								<?php
							if($a_currency_c['location']=='first') echo $a_currency_c['name'].' ';
							echo number_format($order_info_c['total']/$a_currency_c['value'],$a_currency_c['decimal'],$a_currency_c['sep1'],$a_currency_c['sep2']);
							if($a_currency_c['location']=='last') echo ' '.$a_currency_c['name'];
							?>
                                (chưa tính phí vận chuyển)
                            </strong>
						</td>
                    </tr>
					<tr>
						<td colspan="6"><p class="text_nofi font-style-italic"><?php echo __('Sau khi nhận được đơn hàng của quý khách, nhân viên của hàng sẽ liên lạc lại với quý khách để xác nhận lại đơn hàng. Cảm ơn quý khách đã quan tâm đến sản phẩm của chúng tôi !',true)?></p></td>
					</tr>
				</table>
          <div class="submit col-xs-12 text-center m-b-15 m-t-15">
              <?php echo $this->Form->button(__('Tiến hành đặt hàng',true),array('div'=>false,'class'=>'btn btn-default btn-order pull-right', 'onclick'=>"gtag_report_conversion()"))?>
          </div>
			<?php }else echo __('Giỏ hàng trống',true)?>
		</div>
	</div>
	<?php echo $this->Form->end();?>
</article>
<!-- end orders/info.ctp -->

<script>
	$(function(){
		if($('#OrderMethodPayment2').is(':checked')){
			$('#bankinfo').removeClass('hidden');
		}else{
			$('#bankinfo').addClass('hidden');
		}
		$('#OrderMethodPayment2').click(function(){
			$('#bankinfo').removeClass('hidden');
		});
		$('#OrderMethodPayment1').click(function(){
			$('#bankinfo').addClass('hidden');
		});
	});
</script>

<script>
function gtag_report_conversion() {
  var callback = function () {
  	$("#OrderInfoForm").submit();
    // if (typeof(url) != 'undefined') {
    //   window.location = url;
    // }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-663378581/74Z6CPX2ucoBEJW1qbwC',
      'event_callback': callback
  });
  return false;
}
</script>
