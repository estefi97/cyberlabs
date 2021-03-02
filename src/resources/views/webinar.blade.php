@extends('layouts.app')
<title>TV | Cyberlabs</title>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style-hacktiva-live.css') }}">
<style>
  body {
    background-color: white !important;
  }
  .LiveChatWrapper .SmartTabs-tabs {
    background-color: #051626 !important;
  }
  .LiveDetails {
    background-color: #051626 !important;
  }
  .LiveChatWrapper {
    background-color: #051626 !important;
    border-radius: 10px !important;
  }
  .ChatForm {
    background-color: #051626 !important;
  }
  .Message {
    background-color: #051626 !important;
  }
  .LiveContentWrapper-scroll.hide-scrollbar {
    background-color: #051626 !important;
    border-radius: 10px !important;
  }
  .LiveContentWrapper {
    border-radius: 10px !important;
  }
</style>
@section('content')
  <div id="row justify-content-center">
    <div class="BaseLayout">
      <div class="LiveBaseLayout justify-content-center" style="overflow: hidden; margin-top: 45px;">
        <div class="LiveContentWrapper">
          <div class="LiveContentWrapper-scroll hide-scrollbar">
            <div class="LivePlayer-container">
              <div class="LivePlayer-embedCode">
                <iframe
                  title="Platzi Live"
                  allow="autoplay; fullscreen"
                  class="u-videoSource iframe"
                  loading="lazy"
                  frameborder="0"
                  src="{{ $_webinar->all()->last()->link_video }}?autoplay=1"
                  allowfullscreen=""
                ></iframe>
              </div>
            </div>
            <div class="LiveDetails">
              <div class="LiveDetails-top">
                <div class="LiveDetails-top-head">
                  <img src="{{ asset('images/logo_cyberlabs_white.png') }}">
                </div>
              </div>
              <div class="LiveDetails-content">
                <div class="LiveDetails-content-btnShare">
                  <a
                    href="https://twitter.com/intent/tweet?url=https://cyberlabs.test/webinars/&amp;text=Cyberlabs TV es Cyberlabs 24/7"
                    class="LiveDetails-content-btnShare-twitter"
                    target="_blank"
                    rel="noopener"
                    ><svg
                      aria-hidden="true"
                      focusable="false"
                      data-prefix="fab"
                      data-icon="twitter"
                      class="svg-inline--fa fa-twitter fa-w-16"
                      role="img"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512"
                    >
                      <path
                        fill="currentColor"
                        d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"
                      ></path></svg
                    ><span>Twitter</span></a
                  ><a
                    href="https://www.facebook.com/sharer/sharer.php?u=https://cyberlabs.test/webinars/"
                    class="LiveDetails-content-btnShare-facebook"
                    target="_blank"
                    rel="noopener"
                    ><svg
                      aria-hidden="true"
                      focusable="false"
                      data-prefix="fab"
                      data-icon="facebook-f"
                      class="svg-inline--fa fa-facebook-f fa-w-10"
                      role="img"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 320 512"
                    >
                      <path
                        fill="currentColor"
                        d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"
                      ></path></svg
                    ><span>Facebook</span></a
                  >
                </div>
                <div class="LiveDetails-content-btnAdmin"></div>
                <div class="LiveDetails-content-description">
                  <div class="LiveDetails-agenda">
                    <div class="LiveDetails-agenda-markdown">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="LiveChatWrapper" style="height: calc(100vh - 52px)">
          <div class="BestStudents justify-content-center" style="padding-bottom: 0; background-color: #051626 !important; border-radius: 10px !important;">
              <h1 class="LiveDetails-title text-center">{{ __("uneteAlChat") }}</h1>
          </div>
          <div class="SmartTabs">
              <div class="SmartTabs-tabs">
                <div class="SmartTabs-tabs-filter"></div>
              </div>
              <div class="SmartTabs-content-head">
                <div class="TabSectionHead"></div>
              </div>
              <div class="SmartTabs-content" id="SmartTabs-content-id">
                  @forelse($_webinar->orderBy('id', 'asc')->get()->last()->comments as $comment)
                    @forelse($comment->users as $user)
                      <div class="Message">
                    <figure class="Message-avatar">
                      <img
                        src="{{ $user->pathAttachment() }}"
                        alt="{{ $user->name }}"
                        class="Message-avatar-image"
                      /><button class="Message-content-action-reply">
                        <svg
                          aria-hidden="true"
                          focusable="false"
                          data-prefix="far"
                          data-icon="reply"
                          class="svg-inline--fa fa-reply fa-w-18"
                          role="img"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 576 512"
                        >
                          <path
                            fill="currentColor"
                            d="M14.062 257.94L190.06 433.88c30.21 30.21 81.94 8.7 81.94-33.94v-78.28c146.59 8.54 158.53 50.199 134.18 127.879-13.65 43.56 35.07 78.89 72.19 54.46C537.98 464.768 576 403.8 576 330.05c0-170.37-166.04-197.15-304-201.3V48.047c0-42.72-51.79-64.09-81.94-33.94L14.062 190.06c-18.75 18.74-18.75 49.14 0 67.88zM48 224L224 48v128.03c143.181.63 304 11.778 304 154.02 0 66.96-40 109.95-76.02 133.65C501.44 305.911 388.521 273.88 224 272.09V400L48 224z"
                          ></path>
                        </svg></button
                      ><button class="Message-content-action-reply">
                        <svg
                          aria-hidden="true"
                          focusable="false"
                          data-prefix="far"
                          data-icon="reply"
                          class="svg-inline--fa fa-reply fa-w-18"
                          role="img"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 576 512"
                        >
                          <path
                            fill="currentColor"
                            d="M14.062 257.94L190.06 433.88c30.21 30.21 81.94 8.7 81.94-33.94v-78.28c146.59 8.54 158.53 50.199 134.18 127.879-13.65 43.56 35.07 78.89 72.19 54.46C537.98 464.768 576 403.8 576 330.05c0-170.37-166.04-197.15-304-201.3V48.047c0-42.72-51.79-64.09-81.94-33.94L14.062 190.06c-18.75 18.74-18.75 49.14 0 67.88zM48 224L224 48v128.03c143.181.63 304 11.778 304 154.02 0 66.96-40 109.95-76.02 133.65C501.44 305.911 388.521 273.88 224 272.09V400L48 224z"
                          ></path>
                        </svg>
                      </button>
                    </figure>
                    <div class="Message-content">
                      <div class="Message-content-top">
                        <a href="perfil/{{ $user->id }}"><p class="Message-content-author">{{ $user->name }}</p></a>
                        <p class="Message-content-time">{{ $comment->created_at->diffForHumans(null, true) }}</p>
                      </div>
                      <p class="Message-content-message">
                        {{ $comment->comment }}
                      </p>
                    </div>
                  </div>
                    @empty

                    @endforelse
                  @empty

                  @endforelse
              </div>
            </div>
            <div class="wrapper-form">
              <form class="ChatForm" action="{{ route('webinars.agregarComentario') }}" method="POST">
                @csrf
                <input type="hidden" name="idWebinar" value="{{ $_webinar->all()->last()->id }}" />
                <div class="ChatForm-input">
                  <figure class="ChatForm-avatar">
                    <img
                      src="{{ auth()->user()->pathAttachment() }}"
                      alt="Ignacio profile avatar"
                    />
                  </figure>
                  <textarea
                    type="text"
                    name="contenidoComentario"
                    class="ChatForm-field"
                    minlength="2"
                    rows="2"
                    aria-label="{{ __("WebinarEscribeTuComentario") }}"
                    placeholder="{{ __("WebinarEscribeTuComentario") }}"
                    autocomplete="false"
                  ></textarea>
                </div>
                <input style="margin-top: 10px !important; margin-bottom: 10px !important; padding: 1rem 1.5rem 1rem 1.5rem !important; cursor: pointer;" type="submit" value="{{ __("botonWebinar") }}" class="f-main-btn premium-btn pull-right">
              </form>
            </div>
          </div>
        </div>
    </div>
    <div class="Modal">
      <div class="Modal-wrapper">
        <div class="ModalProvider">
          <svg
            aria-hidden="false"
            focusable="false"
            data-prefix="fas"
            data-icon="times"
            class="svg-inline--fa fa-times fa-w-11 ModalProvider-close"
            role="button"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 352 512"
            tabindex="0"
            aria-label="liveChat.modals.close"
          >
            <path
              fill="currentColor"
              d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"
            ></path>
          </svg>
        </div>
      </div>
    </div>
  </div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>
    $(window).on("load", function() {
      $('#SmartTabs-content-id').scrollTop($('#SmartTabs-content-id')[0].scrollHeight);
    });
  </script>
@endsection