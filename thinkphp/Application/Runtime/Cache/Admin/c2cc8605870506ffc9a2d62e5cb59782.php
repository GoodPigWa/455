<?php if (!defined('THINK_PATH')) exit(); if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
		<td><input type="checkbox" value="1" name=""></td>
		<td><?php echo ($vo["category_id"]); ?></td>
		<td style="text-align:left;">
			<?php $__FOR_START_23112__=0;$__FOR_END_23112__=$vo['level']-1;for($i=$__FOR_START_23112__;$i < $__FOR_END_23112__;$i+=1){ ?>--<?php } ?>
			<?php echo ($vo["category_name"]); ?>
		</td>
		<td><?php echo ($vo["sort"]); ?></td>
		<td><?php echo ($vo["is_show"]); ?></td>
		<td><?php echo ($vo["parent_id"]); ?></td>
		<td><?php echo ($vo["level"]); ?></td>
		<td class="td-manage">修改 | 删除</td>
	</tr>
	<?php echo R('Category/tree',array($vo['children'])); endforeach; endif; else: echo "" ;endif; ?>