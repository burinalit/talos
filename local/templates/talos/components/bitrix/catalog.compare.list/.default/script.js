function setCompareProd(ids)
{
	$.each(ids,function(key,val){
	
		var item = $('#compare_'+val);
		if(item.length)
		{	
			item.prop('checked',true);
		}		
	});

}

function delCompareList(id)
{
	$.post(
		EmarketSite.SITE_DIR+"ajax/compare_control.php"
		,
		{
			id:id,
			type:'compare_del',
			list:'CATALOG_COMPARE_LIST'
		},
		function(data)
		{
			$.ajax({
					type: "POST",
					url: EmarketSite.SITE_DIR+"ajax/get_compare.php",
					dataType: "html",
					success: function(html){
						$("#emarket-compare-list").html(html);
						
						var item = $('#compare_'+id);
						if(item.length)
						{	
							item.prop('checked',false);
						}		
						
					}
				});
		}
	)

}