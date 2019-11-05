@extends('layouts.app')

@section('Navigation')
    <Navigation page_title="{{$title}}"></Navigation>
@endsection

@section('content')
<category-edit :category_info="{{ $categoryData }}"></category-edit>
@endsection



   



