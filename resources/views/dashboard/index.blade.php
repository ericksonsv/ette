<x-app-layout :title="__('Dashboard')">
    <x-slot name="header">
        <x-layouts.header-title :text="__('Dashboard')" />
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <x-card>
            <div class="flex items-center justify-between">
                <div class="leading-none p-2">
                    <p class="text-sm text-gray-500">{{ trans('Services') }}</p>
                    <h1 class="text-2xl font-black">{{ $servicesCount }}</h1>
                </div>
                <div class="bg-gray-200 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M12 18.75c-.41 0-.75-.34-.75-.75v-1c0-.41.34-.75.75-.75s.75.34.75.75v1c0 .41-.34.75-.75.75ZM12 22.75c-.41 0-.75-.34-.75-.75v-1c0-.41.34-.75.75-.75s.75.34.75.75v1c0 .41-.34.75-.75.75ZM1.998 22.748c-.06 0-.12-.01-.18-.02-.4-.1-.65-.51-.55-.91l1-4a.75.75 0 1 1 1.46.36l-1 4c-.09.34-.39.57-.73.57ZM21.999 22.749c-.34 0-.64-.23-.73-.57l-1-4c-.1-.4.14-.81.55-.91.4-.1.81.14.91.55l1 4a.748.748 0 0 1-.73.93Z"
                            fill="#3e3173"></path>
                        <path opacity=".4"
                            d="M19.26 9.52c-.11-1.18-.42-2.43-2.71-2.43h-9.1c-2.29 0-2.6 1.26-2.71 2.43l-.4 4.34c-.05.54.13 1.08.5 1.49.38.41.92.65 1.48.65h1.34c1.15 0 1.37-.66 1.52-1.1l.14-.43c.16-.49.2-.61.85-.61h3.65c.64 0 .66.07.85.61l.14.43c.15.44.37 1.1 1.52 1.1h1.34c.56 0 1.1-.24 1.48-.65.37-.4.55-.95.5-1.49l-.39-4.34Z"
                            fill="#3e3173"></path>
                        <path
                            d="M18.42 4.94h-.72l-.27-1.29c-.26-1.25-.79-2.4-2.92-2.4H9.5c-2.13 0-2.66 1.15-2.92 2.4l-.27 1.29h-.72c-.3 0-.54.24-.54.54 0 .3.24.54.54.54h.51l-.3 1.43c.39-.22.92-.36 1.66-.36h9.1c.74 0 1.28.14 1.66.36l-.3-1.43h.51c.3 0 .54-.24.54-.54a.553.553 0 0 0-.55-.54ZM9.86 11.01H7.72c-.3 0-.54-.24-.54-.54 0-.3.24-.54.54-.54h2.14c.3 0 .54.24.54.54a.55.55 0 0 1-.54.54ZM16.282 11.01h-2.14c-.3 0-.54-.24-.54-.54 0-.3.24-.54.54-.54h2.14c.3 0 .54.24.54.54 0 .3-.24.54-.54.54Z"
                            fill="#3e3173"></path>
                    </svg>
                </div>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div class="leading-none p-2">
                    <p class="text-sm text-gray-500">{{ trans('Drivers') }}</p>
                    <h1 class="text-2xl font-black">{{ $drivers }}</h1>
                </div>
                <div class="bg-gray-200 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none">
                        <path opacity=".4"
                            d="M22.182 13.66c-.15-1.65-.59-3.41-3.8-3.41H5.621c-3.21 0-3.64 1.76-3.8 3.41l-.56 6.09c-.07.76.18 1.52.7 2.09.53.58 1.28.91 2.08.91h1.88c1.62 0 1.93-.93 2.13-1.54l.2-.6c.23-.69.29-.86 1.19-.86h5.12c.9 0 .93.1 1.19.86l.2.6c.2.61.51 1.54 2.13 1.54h1.88c.79 0 1.55-.33 2.08-.91.52-.57.77-1.33.7-2.09l-.56-6.09Z"
                            fill="#3e3173"></path>
                        <path
                            d="M21 7.248h-1.02l-.38-1.81c-.36-1.75-1.11-3.36-4.09-3.36H8.49c-2.98 0-3.73 1.61-4.09 3.36l-.38 1.81H3c-.41 0-.75.34-.75.75s.34.75.75.75h.71l-.42 2c.54-.31 1.29-.5 2.33-.5h12.76c1.04 0 1.79.19 2.33.5l-.42-2H21c.41 0 .75-.34.75-.75s-.34-.75-.75-.75ZM9 15.75H6c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h3c.41 0 .75.34.75.75s-.34.75-.75.75ZM18 15.75h-3c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h3c.41 0 .75.34.75.75s-.34.75-.75.75Z"
                            fill="#3e3173"></path>
                    </svg>
                </div>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div class="leading-none p-2">
                    <p class="text-sm text-gray-500">{{ trans('Users') }}</p>
                    <h1 class="text-2xl font-black">{{ $users }}</h1>
                </div>
                <div class="bg-gray-200 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none">
                        <path opacity=".4"
                            d="M9 2C6.38 2 4.25 4.13 4.25 6.75c0 2.57 2.01 4.65 4.63 4.74.08-.01.16-.01.22 0h.07a4.738 4.738 0 0 0 4.58-4.74C13.75 4.13 11.62 2 9 2Z"
                            fill="#3e3173"></path>
                        <path
                            d="M14.08 14.149c-2.79-1.86-7.34-1.86-10.15 0-1.27.85-1.97 2-1.97 3.23s.7 2.37 1.96 3.21c1.4.94 3.24 1.41 5.08 1.41 1.84 0 3.68-.47 5.08-1.41 1.26-.85 1.96-1.99 1.96-3.23-.01-1.23-.7-2.37-1.96-3.21Z"
                            fill="#3e3173"></path>
                        <path opacity=".4"
                            d="M19.99 7.338c.16 1.94-1.22 3.64-3.13 3.87h-.05c-.06 0-.12 0-.17.02-.97.05-1.86-.26-2.53-.83 1.03-.92 1.62-2.3 1.5-3.8a4.64 4.64 0 0 0-.77-2.18 3.592 3.592 0 0 1 5.15 2.92Z"
                            fill="#3e3173"></path>
                        <path
                            d="M21.988 16.59c-.08.97-.7 1.81-1.74 2.38-1 .55-2.26.81-3.51.78.72-.65 1.14-1.46 1.22-2.32.1-1.24-.49-2.43-1.67-3.38-.67-.53-1.45-.95-2.3-1.26 2.21-.64 4.99-.21 6.7 1.17.92.74 1.39 1.67 1.3 2.63Z"
                            fill="#3e3173"></path>
                    </svg>
                </div>
            </div>
        </x-card>

    </div>

    <x-card>
        <h1 class="text-3xl text-center mb-12">{{ trans('Services Calendar') }}</h1>
        <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/main.min.css') }}">
        <script src="{{ asset('vendor/fullcalendar/main.min.js') }}"></script>
        <script src="{{ asset('vendor/fullcalendar/locales-all.min.js') }}"></script>
        <style>
            .fc-header-toolbar {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
            .fc-toolbar-title {
                font-weight: bolder;
                padding: 10px 0;
            }
            @media (min-width: 768px) {
                .fc-header-toolbar {
                    flex-direction: row;
                }
                .fc-toolbar-title {
                    padding: 0;
                }
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
              var calendarEl = document.getElementById('calendar');
              var calendar = new FullCalendar.Calendar(calendarEl, {
                expandRows: true,
                initialView: 'dayGridDay',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                locale: 'es',
                height: 'auto',
                dayMaxEvents: true,
                navLinks: true, // can click day/week names to navigate views
                nowIndicator: true,
                events: @json($services),
              });

              calendar.render();
            });

        </script>
        <div id='calendar'></div>
    </x-card>

</x-app-layout>
