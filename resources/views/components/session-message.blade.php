@if($message = Session::get('success'))
<div class="mt-4 alert alert-success">
    <p> {{ $message }}</p>
</div>
@elseif (session()->has('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<script>
    $(document).ready(function() {
        window.livewire.on('alert_remove', () => {
            setTimeout(function() {
                $(".alert-success").fadeOut('fast');
            }, 3000);
        });
    });
</script>
