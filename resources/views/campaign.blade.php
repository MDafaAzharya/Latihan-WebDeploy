@extends('layouts.index')


@section('css')
@endsection


@section('content')
  <section class="section-dr-py bg-body ">
    <div class="container">
      <h3 class="text-center mb-3 mb-md-5"><span class="section-title">Program Terdaftar</h3>
      <div class="card">
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
    </div>
  </section>
@endsection



@section('script')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      themeSystem: 'bootstrap5',
      events: `{{ route('campaign-show') }}`,
      })
      calendar.render();
    });
</script>
@endsection
