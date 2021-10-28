@extends("layout.management")

@section("management-content")
  <management-advanced-app
    :groups="{{str_replace("\"", "'", json_encode($groups))}}"
    update-route="{{route("management.advanced.update", ["setting" => "___INSERT_SETTING___"])}}"
    >

    <template slot-scope="props">
    @foreach($groups as $i => $group)
      @foreach($group["settings"] as $j => $setting)
        <div v-if="props.isSelected({{$i}}, {{$j}})" :key="{{$i."-".$j}}">
          {!!$setting["display"]!!}
        </div>
      @endforeach
    @endforeach
    </template>
  </management-advanced-app>
@endsection
