$(document).ready(function(){
	var url_ctrl = site_url+"request/print_jadwal/";
	
	var table = $('#tabel_custom').DataTable({
        "ajax": url_ctrl+'table',
        "deferRender": true,
        "searching": false,
        "paging":   false,
        "info":     false,
        "ordering": false,
        "order": [["0", "desc"]]
    });
});