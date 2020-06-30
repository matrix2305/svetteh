<div class="contact-footer">
    <div class="contact-info">
        <h3>Kontakt informacije:</h3>
        <p><b>{{$content->name}}</b></p>
        <p><b>E-pošta:</b> {{$content->email}}</p>
        @if($content->phone != null)
            <p><b>Mobilni telefon:</b> {{$content->phone}}</p>
        @endif
        @if($content->adress != null)
            <p><b>Adresa:</b> {{$content->adress}}</p>
        @endif
        <div>
            @if($content->facebook != null)
                <a href="{{$content->facebook}}"><i class="fab fa-facebook-f"></i></a>
            @endif
            @if($content->instagram != null)
                <a href="{{$content->instagram}}"><i class="fab fa-instagram"></i></a>
            @endif
        </div>
    </div>
    <div class="contact-form">
        <div class="contactform">
            @if($message = session('success'))
                <div class="true-message">
                    <p>{{$message}}</p>
                </div>
            @endif
            <form method="POST" action="{{route('email')}}">
                @csrf
                <div></div>
                <label> Ime: *</label>
                <input type="text" name="name"  placeholder="vaše ime..">

                <label>Email: * </label>
                <input type="email" name="email" placeholder="vaša e-pošta..">

                <label>Poruka: </label>
                <textarea name="message" placeholder="poruka..." style="height:200px"></textarea>

                <button>Pošalji</button>
            </form>
        </div>
    </div>
</div>
