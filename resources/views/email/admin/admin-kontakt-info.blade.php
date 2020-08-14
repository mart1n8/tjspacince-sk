<div>
    <h3>Kontaktovanie administrátora:</h3>
    <h2>{{ $msgEmail }}</h2>
    @if($msgRegUser!=NULL)
      <span>registrovaný užívateľ</span>
    @else
      <span>neregistrovaný užívateľ</span>
    @endif
    <p>
        {{ $msg }}
    </p>
</div>