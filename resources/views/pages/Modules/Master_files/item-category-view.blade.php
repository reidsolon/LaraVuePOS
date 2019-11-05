@extends('layouts.app')

@section('Navigation')
    <Navigation page_title="{{$title}}"></Navigation>
@endsection

@section('content')
<category-view :category_info="{{ $categoryData }}"></category-view>
@endsection



   



