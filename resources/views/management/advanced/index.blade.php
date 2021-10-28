@extends("layout.management")

@section("management-content")
  <management-advanced-app :groups="{{str_replace("\"", "'", json_encode($groups))}}">
    <template slot-scope="props">
    @foreach($groups as $i => $group)
      @foreach($group["settings"] as $j => $setting)
        <div v-if="props.isSelected({{$i}}, {{$j}})">
          {!!$setting["display"]!!}
        </div>
      @endforeach
    @endforeach
    </template>
  </management-advanced-app>
@endsection
