@extends('layout.app')

@section('content')
<main class="tp-dashboard-body-bg">
   <div class="tpd-dashboard-wrap-bg" data-background="assets/img/dashboard/bg/dashboard-bg-shape-1.jpg">
       <div class="tpd-continue-learning-wrapper">
           <div class="tpd-continue-learning-sidebar">
               <div class="tpd-continue-learning-accordion">
                   <div class="accordion" id="accordionExample">
                    @foreach ($topics as $topic)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $topic->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $topic->id }}" aria-expanded="true"
                                aria-controls="collapse{{ $topic->id }}">
                                {{ $topic->title }}
                                <span>{{ $topic->lessons->count() }}/{{ $topic->lessons->count() }}</span>
                            </button>
                        </h2>
                        <div id="collapse{{ $topic->id }}" class="accordion-collapse collapse show"
                            aria-labelledby="heading{{ $topic->id }}" data-bs-parent="#accordionExample">
                            <div class="tpd-continue-learning-body">
                                <div class="tpd-continue-learning-body-item">
                                    @foreach ($topic->lessons as $lesson)
                                        <a href="#" class="lesson-link" data-video-url="{{ Storage::url($lesson->video) }}" data-description="{{ $lesson->content }}">
                                            <p>
                                                <span>
                                                    <!-- SVG Icon -->
                                                </span>{{ $lesson->title }}
                                            </p>
                                            <i class="fa-solid fa-circle-check"></i>
                                        </a>
                                    @endforeach
                                    @if($topic->quizzes->isEmpty())
                                    <a >
                                    <p>No quizzes available for this topic.</p></a>
                                @else
                                    <ul>
                                        @foreach ($topic->quizzes as $quiz)
                                           
                                                <a href="{{ route('quizzes.show', $quiz->id) }}"><p><span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M14.2663 6.552H11.9757C10.0973 6.552 8.56768 5.008 8.56768 3.112V0.8C8.56768 0.36 8.21102 0 7.77511 0H4.41461C1.9735 0 0 1.6 0 4.456V11.544C0 14.4 1.9735 16 4.41461 16H10.6442C13.0853 16 15.0588 14.4 15.0588 11.544V7.352C15.0588 6.912 14.7022 6.552 14.2663 6.552Z" fill="currentColor"></path>
                                                    <path d="M10.5439 0.168092C10.219 -0.159908 9.65625 0.0640922 9.65625 0.520092V3.31209C9.65625 4.48009 10.639 5.44809 11.8358 5.44809C12.5888 5.45609 13.6349 5.45609 14.5306 5.45609C14.9823 5.45609 15.2201 4.92009 14.9031 4.60009C13.7618 3.44009 11.7169 1.35209 10.5439 0.168092Z" fill="currentColor"></path>
                                                    <path d="M8.71703 9.4002H3.96161C3.63666 9.4002 3.36719 9.1282 3.36719 8.8002C3.36719 8.4722 3.63666 8.2002 3.96161 8.2002H8.71703C9.04199 8.2002 9.31146 8.4722 9.31146 8.8002C9.31146 9.1282 9.04199 9.4002 8.71703 9.4002Z" fill="currentColor"></path>
                                                    <path d="M7.13189 12.6H3.96161C3.63666 12.6 3.36719 12.328 3.36719 12C3.36719 11.672 3.63666 11.4 3.96161 11.4H7.13189C7.45685 11.4 7.72632 11.672 7.72632 12C7.72632 12.328 7.45685 12.6 7.13189 12.6Z" fill="currentColor"></path>
                                                  </svg></span>{{$quiz->title}}</p></a> <!-- Adjust route as necessary -->
                                            
                                        @endforeach
                                    </ul>
                                @endif
                                </div>
                                <!-- Display quizzes for the current topic -->
                           
                                    
                              
                               
                            </div>
                        </div>
                    </div>
                @endforeach
                
                   </div>
               </div>
           </div>
           <div class="tpd-continue-learning-main">
               <div class="tpd-continue-learning-about-bg">
                  <div class="tpd-continue-learning-about-thumb mb-45">
                     <video style="width: 70%;margin-left:10%;margin-top:5%" id="lesson-video" controls></video>
                 </div>
                   <div style="width: 75%" class="tpd-continue-learning-about-wrapper">
                       <h4>About Lesson</h4>
                       <p id="lesson-description"></p>
                   </div>
               </div>
           </div>
       </div>
   </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
   const videoElement = document.getElementById('lesson-video');
   const descriptionElement = document.getElementById('lesson-description');
   const lessonLinks = document.querySelectorAll('.lesson-link');

   lessonLinks.forEach(link => {
       link.addEventListener('click', function (event) {
           event.preventDefault();
           
           const videoUrl = this.getAttribute('data-video-url');
           const lessonDescription = this.getAttribute('data-description');

           // Set the video source and load it
           videoElement.src = videoUrl;
           videoElement.load();
           videoElement.play();

           // Update the lesson description
           descriptionElement.textContent = lessonDescription;
       });
   });
});
</script>
@stop
