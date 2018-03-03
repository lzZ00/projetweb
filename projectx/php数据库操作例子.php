<?php
$this->db->limit(1); //只选第一个
$this->db->order_by("c.rowid", "desc");

?>


//选中class
$(".cond_reglement").val(cond_reglement);
