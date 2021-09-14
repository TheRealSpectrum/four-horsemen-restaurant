Management: create

<form action="{{route("management.$managementName.store")}}" method="post">
  @csrf
  <label for="name">Name</label>
  <input type="text" name="name">
  <label for="price">Price</label>
  <input type="number" name="price">

  <x-button type="submit">Create dish</x-button>
</form>
