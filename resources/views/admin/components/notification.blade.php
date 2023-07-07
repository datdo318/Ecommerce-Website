@if (session('notification'))
    <div class="alert aleart-warning" role="alert">
        {{ session('notification') }}
    </div>
    
@endif