<?php echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));?>

<div id="column_right">
	<!-- tab --> 
	<div id="action_top">
		<ul class="tabs">
    		<li><a href="#tab1"><?php echo __('Thông tin',true)?></a></li>
    	</ul> <!-- end .tabs -->
    		
    	<ul class="action_top_2">
    		<li><?php echo $this->Html->link('&nbsp;',array('action'=>'index'),array('title'=>__('Thoát',true),'class'=>'exit','escape'=>false))?></li>
    	</ul> <!-- end .action_top_2 -->
	</div> <!--  end #action_top -->
	
	<div id="content">
		<?php echo $this->Form->create('Faq',array('id'=>'form','inputDefaults'=>array('label'=>false,'div'=>false)))?>
		
		<div class="tab_container">
			<ul class="submit">
				<li><?php echo $this->Form->submit(__('Lưu',true),array('name'=>'save','div'=>false))?><span></span></li>
				<li><?php echo $this->Form->submit(__('Lưu & Thêm mới',true),array('name'=>'save_add','div'=>false))?><span></span></li>
				<li><?php echo $this->Form->submit(__('Lưu và Thoát',true),array('name'=>'save_exit','div'=>false))?><span></span></li>
			</ul> <!-- end .submit -->
			
			<div id="tab1" class="tab_content">
				<table class="add">
					<tr>
						<th><?php echo $this->Form->label('faq_category_id',__('Nhóm',true))?> <span class="im">*</span></th>
						<td><?php echo $this->Form->input('faq_category_id',array('type'=>'select','options'=>$a_list_categories_c,'empty'=>__('Chọn nhóm câu hỏi',true),'class'=>'medium','required'=>true))?></td>
					</tr>
					<tr>
						<th><?php echo $this->Form->label('question',__('Câu hỏi',true))?> <span class="im">*</span></th>
						<td><?php echo $this->Form->input('question',array('class'=>'larger','onchange'=>'getFieldByName("Faq","Question")'))?></td>
					</tr>
					<?php if(!empty($oneweb_seo)){?>
					<tr>
						<th><?php echo $this->Form->label('slug',__('Slug',true))?></th>
						<td><?php echo $this->Form->input('slug',array('class'=>'larger','required'=>false))?></td>
					</tr>
					<?php }?>
					<tr>
						<th><?php echo $this->Form->label('answer',__('Câu trả lời',true))?> <span class="im">*</span></th>
						<td>
							<?php 
								echo $this->Form->input('answer', array('type'=> 'textarea','div'=>'description','required'=>false));
								echo $this->CkEditor->create('Faq.answer',array('toolbar'=>'user'));	
							?>
						</td>
					</tr>
					<tr>
						<th><?php echo $this->Form->label('sort',__('Sắp xếp',true))?></th>
						<td><?php echo $this->Form->input('sort',array('class'=>'small'))?></td>
					</tr>
					<tr>
						<th><?php echo $this->Form->label('most',__('Thường gặp',true))?></th>
						<td><?php echo $this->Form->checkbox('most')?></td>
					</tr>
					<tr>
						<th><?php echo $this->Form->label('status',__('Kích hoạt',true))?></th>
						<td><?php echo $this->Form->checkbox('status',array('checked'=>true))?></td>
					</tr>
				</table> <!-- end .add -->
			</div> <!-- end #tab1 -->
			
			<ul class="submit">
				<li><?php echo $this->Form->submit(__('Lưu',true),array('name'=>'save','div'=>false))?><span></span></li>
				<li><?php echo $this->Form->submit(__('Lưu & Thêm mới',true),array('name'=>'save_add','div'=>false))?><span></span></li>
				<li><?php echo $this->Form->submit(__('Lưu & Thoát',true),array('name'=>'save_exit','div'=>false))?><span></span></li>
				<li><?php echo $this->Html->link(__('Thoát',true),array('action'=>'index'),array('class'=>'exit'))?></li>
			</ul> <!-- end .submit -->
			
		</div> <!-- end .tab_container -->
		
		<?php echo $this->Form->end();?>
	</div> <!--  end #content -->
</div> <!--  end #column_right -->