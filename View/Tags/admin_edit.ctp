<?php echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));?>
<div id="column_right">
	<!-- tab -->
	<div id="action_top">
		<ul class="tabs">
   			<li><a href="#tab1"><?php echo __('Thông tin',true)?></a></li>
   			<?php if(!empty($oneweb_seo)){?>
   			<li><a href="#tab2"><?php echo __('SEO',true)?></a></li>
   			<?php }?>
   		</ul> <!-- end .tabs -->

    	<ul class="action_top_2">
    		<li><?php echo $this->Html->link('&nbsp;',(!empty($_GET['url']))?urldecode($_GET['url']):array('action'=>'index'),array('title'=>__('Thoát',true),'class'=>'exit','escape'=>false))?></li>
   		</ul> <!-- end .action_top_2 -->
	</div> <!--  end #action_top -->

	<div id="content">
		<?php
			echo $this->Form->create('Tag',array('type'=>'file','id'=>'form','url'=>array('action'=>'edit','?'=>array('url'=>(!empty($_GET['url']))?urldecode($_GET['url']):'')),'inputDefaults'=>array('label'=>false,'div'=>false)));
			echo $this->Form->input('id');
		?>

		<div class="tab_container">
			<ul class="submit">
				<li><?php echo $this->Form->submit(__('Lưu',true),array('name'=>'save','div'=>false))?><span></span></li>
				<li><?php echo $this->Form->submit(__('Lưu và Thoát',true),array('name'=>'save_exit','div'=>false))?><span></span></li>
			</ul> <!-- end .submit -->

			<div id="tab1" class="tab_content">
				<table class="add">
					<tr>
						<th><?php echo $this->Form->label('name',__('Tiêu đề',true))?> <span class="im">*</span></th>
						<td><?php echo $this->Form->input('name',array('class'=>'larger','onchange'=>'getFieldByName("Tag")'))?></td>
					</tr>

					<tr>
						<td colspan="2">
							<div class="tab_container_2">
								<div id="tab21" class="tab_content_2">
									<?php
										echo $this->Form->input('description', array('type'=> 'textarea','div'=>'description'));
										echo $this->CkEditor->create('Tag.description',array('toolbar'=>'full'));
									?>
								</div> <!-- end #tab21 -->
							</div> <!-- end .tab_container_2 -->
						</td>
					</tr>
					<tr>
						<th><?php echo $this->Form->label('Ngày sửa',__('Ngày sửa',true))?></th>
						<td><?php echo $this->Form->input('modified',array('type'=>'datetime','minYear'=>date('Y')-5,'maxYear'=>date('Y')+5,'timeFormat'=>24,'empty'=>false))?></td>
					</tr>



					<?php if(!empty($oneweb_seo)){?>
					<tr>
						<th><?php echo $this->Form->label('target',__('Target',true))?></th>
						<td><?php echo $this->Form->input('target',array('type'=>'select','options'=>array('_self'=>'_self','_blank'=>'_blank'),'class'=>'medium'))?></td>
					</tr>
					<?php }?>
					<tr>
						<th><?php echo $this->Form->label('status',__('Kích hoạt',true))?></th>
						<td><?php echo $this->Form->checkbox('status')?></td>
					</tr>
				</table> <!-- end .add -->
			</div> <!-- end #tab1 -->

			<?php if(!empty($oneweb_seo)){?>
			<div id="tab2" class="tab_content">
				<table class="add">
					<tr>
						<th><?php echo $this->Form->label('slug',__('Slug',true))?></th>
						<td><?php echo $this->Form->input('slug',array('class'=>'larger','required'=>false))?></td>
					</tr>
					<tr>
						<th><?php echo $this->Form->label('meta_title',__('Meta title',true))?></th>
						<td><?php echo $this->Form->input('meta_title',array('class'=>'larger','required'=>false))?></td>
					</tr>
					<tr>
						<th><?php echo $this->Form->label('meta_keyword',__('Meta keyword',true))?></th>
						<td><?php echo $this->Form->input('meta_keyword',array('class'=>'larger'))?></td>
					</tr>
					<tr>
						<th><?php echo $this->Form->label('meta_description',__('Meta description',true))?></th>
						<td><?php echo $this->Form->input('meta_description',array('class'=>'medium'))?></td>
					</tr>
					<tr>
						<th><?php echo $this->Form->label('meta_robots',__('Meta robots',true))?></th>
						<td><?php echo $this->Form->input('meta_robots',array('type'=>'select','options'=>array('index,follow'=>'index,follow','noindex,nofollow'=>'noindex,nofollow','index,nofollow'=>'index,nofollow','noindex,follow'=>'noindex,follow'),'class'=>'medium'))?></td>
					</tr>
					<tr>
						<th><?php echo $this->Form->label('rel',__('Rel',true))?></th>
						<td><?php echo $this->Form->input('rel',array('type'=>'select','options'=>array('dofollow'=>'dofollow','nofollow'=>'nofollow'),'class'=>'medium'))?></td>
					</tr>
				</table> <!-- end .add -->
			</div> <!-- end #tab2 -->
			<?php }?>

			<ul class="submit">
				<li><?php echo $this->Form->submit(__('Lưu',true),array('name'=>'save','div'=>false))?><span></span></li>
				<li><?php echo $this->Form->submit(__('Lưu & Thêm mới',true),array('name'=>'save_add','div'=>false))?><span></span></li>
				<li><?php echo $this->Form->submit(__('Lưu & Thoát',true),array('name'=>'save_exit','div'=>false))?><span></span></li>
				<li><?php echo $this->Html->link(__('Thoát',true),(!empty($_GET['url']))?urldecode($_GET['url']):array('action'=>'index'),array('class'=>'exit'))?></li>
			</ul> <!-- end .submit -->

		</div> <!-- end .tab_container -->

		<?php echo $this->Form->end();?>
	</div> <!--  end #content -->
</div> <!--  end #column_right -->

<?php
if(!empty($oneweb_post['tag'])){
	echo $this->Html->script(array('jquery-ui/autocomplete/jquery.ui.core','jquery-ui/autocomplete/jquery.ui.menu','jquery-ui/autocomplete/jquery.ui.position','jquery-ui/autocomplete/jquery.ui.widget','jquery-ui/autocomplete/jquery-ui-1.9.2.custom',));
}
?>

<script type="text/javascript">

	$(function() {
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$( ".auto_complete_tag" )
		// don't navigate away from the field on tab when selecting an item
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
					$( this ).data( "ui-autocomplete" ).menu.active ) {
				event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: function( request, response ) {

				// delegate back to autocomplete, but extract the last term
				$.ajax({
					url: "<?php echo $this->Html->url(array('controller'=>'products', 'action'=>'ajaxLoadTag'))?>",
					dataType: "json",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						name_startsWith: extractLast( request.term )
					},
					success: function( data ) {
						$("#ui-id-1").html('');
						if(data.length ==0){
							$("#ui-id-1").append('<li class="ui-menu-item"><a href="javascript:;">Không tìm thấy tag</a></li>');
						}else{

							response( $.ui.autocomplete.filter(
									data, extractLast( request.term ) ) );
						}

					}
				});
			},
			focus: function() {
				// prevent value inserted on focus
				return false;
			},
			select: function( event, ui ) {
				var terms = split( this.value );
				// remove the current input
				terms.pop();
				// add the selected item
				terms.push( ui.item.value );
				// add placeholder to get the comma-and-space at the end
				terms.push( "" );
				this.value = terms.join( ", " );
				return false;
			}
		});


	});
</script>
