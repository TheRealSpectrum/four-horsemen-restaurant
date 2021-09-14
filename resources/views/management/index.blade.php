Management: index

@foreach($models as $model)

  <div>
    <div>{{$model->name}}</div>
    <div>{{$model->priceAsString()}}</div>
  </div>
  <div>----</div>

@endforeach
