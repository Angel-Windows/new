<div class="charList">
    <?php $count = 0; ?>

    @foreach(unserialize($prod->specification) as $dtbl)
        @if($count++ > 2)
                <?php break; ?>
        @endif
        <div class="item">
            <div class="name">{{ $dtbl['name'] }}</div>
            <div class="value">{{ $dtbl['value'] }}</div>
            {{--																{{$dtbl->nameOptionVariant()}}--}}
        </div>
    @endforeach
</div>