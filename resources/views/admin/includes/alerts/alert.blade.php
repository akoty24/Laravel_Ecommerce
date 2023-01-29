<script>
    var msg = '{{Session::get('alert')}}';
    var errormsg = '{{Session::get('errorAlert')}}';
    var exist = '{{Session::has('alert')}}';
    var exist2 = '{{Session::has('errorAlert')}}';
    if(exist){
        alert(msg);
    }
    if(exist2){
        alert(errormsg);
    }

</script>