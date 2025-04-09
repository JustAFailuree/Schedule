<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en" xmlns:th="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Index</title>
    <link rel="stylesheet" href="https://unpkg.com/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" type="image/png" href="favicon.png" />
  </head>

  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        
        <a class="navbar-item" href="index.php">
            Moja Strona
        </a>

       
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

   
    <div id="navbarMenu" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="schedule.php">Plan</a>
            <a class="navbar-item" href="#about-us">O nas</a>
            <a class="navbar-item" href="#services">Usługi</a>
            <a class="navbar-item" href="#my-university">Uniwersytet</a>
            <a class="navbar-item" href="#contact">Kontakt</a>
        </div>

        <div class="navbar-end">
            <a class="navbar-item" href="login.php">
                <span>Wyloguj</span>
            </a>
        </div>
    </div>
</nav>
  <body>

    <div class="preloader-wrapper">
        <div class="preloader">
          <img src="images/MainPhoto.jpg" alt="" class="background-image" />
          <div class="overlay">
            <h1 class="subtitle">Welcome To Our</h1>
            <h2 class="title">University</h2>
          </div>
        </div>
      </div>

      </section>
    </div>

    <div class="main-content">
      <div class="section-light about-me" id="about-us">
        <div class="container">
          <div class="column is-12 about-me">
            <h1 class="title has-text-centered section-title">About Us</h1>
          </div>
          <div class="columns is-multiline">
            <div
              class="column is-6 has-vertically-aligned-content"
              data-aos="fade-right"
            >
              <p class="is-larger has-text-white">
                &emsp;&emsp;<strong class="has-text-white">
                    Suspendisse velit sapien, rhoncus in finibus quis, 
                    pellentesque non justo. Mauris volutpat ut velit at
                     hendrerit. Donec placerat efficitur finibus.
                      In maximus suscipit maximus. Proin eu pharetra quam.</strong>
              </p>
              <br />
              <p class="has-text-white">
                Interdum et malesuada fames ac ante ipsum primis in faucibus. 
                Suspendisse potenti. Fusce consequat tellus elit. Sed non mi erat.
                 Suspendisse enim ipsum, eleifend vitae sagittis ut, faucibus a nisi.
                  Quisque nibh libero, dignissim et nibh nec, laoreet tempor leo. 
                  Nunc facilisis lorem vel egestas tincidunt. Vestibulum ultricies 
                  congue massa, quis feugiat quam.
              </p>
              <br />
              <div class="is-divider"></div>
              <div class="columns about-links">
                <div class="column has-text-white">
                  <p class="heading has-text-white">
                    <strong class="has-text-white">Give us a ring</strong>
                  </p>
                  <p class="subheading has-text-white">
                    +261 34 05 024 91
                  </p>
                </div>
                <div class="column">
                  <p class="heading">
                    <strong class="has-text-white">Email Us</strong>
                  </p>
                  <p class="subheading has-text-white">
                    ContactUs@example.com
                  </p>
                </div>
              </div>
            </div>
            <div class="column is-6 right-image " data-aos="fade-left">
              <img
                class="is-rounded"
                src="https://picsum.photos/id/100/600/375"
                alt=""
              />
            </div>
          </div>
        </div>
      </div>

      <div class="section-dark resume">
        <div class="container">
          <div
            class="columns is-multiline"
            data-aos="fade-in"
            data-aos-easing="linear"
          >
            <div class="column is-12 about-me">
              <h1 class="title has-text-centered section-title">
                View My Resume
              </h1>
            </div>
            <div class="column is-10 has-text-centered is-offset-1">
              <h2 class="subtitle">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et doloremagna aliqua
              </h2>
              <form action="example.docs">
                <button class="button">
                  Download Resume&emsp;<i class="fad fa-download fa-lg"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="section-color services" id="services">
        <div class="container">
          <div class="columns is-multiline">
            <div
              class="column is-12 about-me"
              data-aos="fade-in"
              data-aos-easing="linear"
            >
              <h1 class="title has-text-centered section-title">Services</h1>

              <h2 class="subtitle">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua
              </h2>
              <br />
            </div>
            <div class="columns is-12">
              <div
                class="column is-4 has-text-centered"
                data-aos="fade-in"
                data-aos-easing="linear"
              >
                <i class="fad fa-meteor fa-3x"></i>
                <hr />
                <h2 class="has-text-white">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                </h2>
              </div>
              <div
                class="column is-4 has-text-centered"
                data-aos="fade-in"
                data-aos-easing="linear"
              >
                <i class="fas fa-paint-brush fa-3x"></i>
                <hr />
                <h2  class="has-text-white">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                </h2>
              </div>
              <div
                class="column is-4 has-text-centered"
                data-aos="fade-in"
                data-aos-easing="linear"
              >
                <i class="fas fa-rocket fa-3x"></i>
                <hr />
                <h2  class="has-text-white">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                </h2>
              </div>
            </div>
            <hr />
            <div class="columns is-12">
              <div
                class="column is-4 has-text-centered"
                data-aos="fade-in"
                data-aos-easing="linear"
              >
                <i class="fas fa-upload fa-3x"></i>
                <hr />
                <h2  class="has-text-white">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                </h2>
              </div>
              <div
                class="column is-4 has-text-centered"
                data-aos="fade-in"
                data-aos-easing="linear"
              >
                <i class="fas fa-bus fa-3x"></i>
                <hr />
                <h2  class="has-text-white">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                </h2>
              </div>
              <div
                class="column is-4 has-text-centered"
                data-aos="fade-in"
                data-aos-easing="linear"
              >
                <i class="fas fa-code fa-3x"></i>
                <hr />
                <h2  class="has-text-white">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                </h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="section-dark my-work" id="my-university">
        <div class="container">
          <div
            class="columns is-multiline"
            data-aos="fade-in"
            data-aos-easing="linear"
          >
            <div class="column is-12">
              <h1 class="title has-text-centered section-title">My University</h1>
            </div>
            <div class="column is-3">
              <a href="#">
                <figure
                  class="image is-2by1 work-item"
                  style="background-image: url('https://fastly.picsum.photos/id/234/320/180.jpg?grayscale&hmac=Puq4Az5sGbyIxN_dLdUNLopCK-1F3Ys14iQrH69c6WQ');"
                ></figure>
              </a>
            </div>
            <div class="column is-3">
              <a href="#">
                <figure
                  class="image is-2by1 work-item"
                  style="background-image: url('https://fastly.picsum.photos/id/77/320/180.jpg?grayscale&hmac=zYEsKuzAjq4uyzx5OD_DV1BY7xAFAEQDATvqZElyWgI');"
                ></figure>
              </a>
            </div>
            <div class="column is-3">
              <a href="#">
                <figure
                  class="image is-2by1 work-item"
                  style="background-image: url('https://fastly.picsum.photos/id/6/320/180.jpg?grayscale&hmac=IueidwY8MZXwovqFObHGJpBFuulKPlB8-5Z7bBnnZ-I');"
                ></figure>
              </a>
            </div>
            <div class="column is-3">
              <a href="#">
                <figure
                  class="image is-2by1 work-item"
                  style="background-image: url('https://fastly.picsum.photos/id/103/320/180.jpg?grayscale&hmac=3hSem2nQqJFjscJrb8WKyyWyd08VUrDty-krJpoZWPg');"
                ></figure>
              </a>
            </div>
            <div class="column is-3">
              <a href="#">
                <figure
                  class="image is-2by1 work-item"
                  style="background-image: url('https://fastly.picsum.photos/id/134/320/180.jpg?grayscale&hmac=GsR2AAThVnf1919I4DnROOOknH2icTz1dsy9MALrssg');"
                ></figure>
              </a>
            </div>
            <div class="column is-3">
              <a href="#">
                <figure
                  class="image is-2by1 work-item"
                  style="background-image: url('https://fastly.picsum.photos/id/1/320/180.jpg?grayscale&hmac=7ofSRexxvmgfKRlEX7Ihm_Bw9HG1qcdqnJX0RQYQofA');"
                ></figure>
              </a>
            </div>
            <div class="column is-3">
              <a href="#">
                <figure
                  class="image is-2by1 work-item"
                  style="background-image: url('https://fastly.picsum.photos/id/69/320/180.jpg?grayscale&hmac=ildEL7POR863M183M_A99AunlBnPPsVOsPhMsrzjyXY');"
                ></figure>
              </a>
            </div>
            <div class="column is-3">
              <a href="#">
                <figure
                  class="image is-2by1 work-item"
                  style="background-image: url('https://fastly.picsum.photos/id/30/320/180.jpg?grayscale&hmac=BwJQR-z0HV8vj9XK9TtxdO3m6Qz3R_SIr8iXuw7XxJ4');" 
                ></figure>
              </a>
            </div>
          </div>
        </div>
      </div>

<!--      <div class="section-light contact" id="contact">-->
<!--        <div class="container">-->
<!--          <div-->
<!--            class="columns is-multiline"-->
<!--            data-aos="fade-in-up"-->
<!--            data-aos-easing="linear"-->
<!--          >-->
<!--            <div class="column is-12 about-me">-->
<!--              <h1 class="title has-text-centered section-title">-->
<!--                Get in touch-->
<!--              </h1>-->
<!--            </div>-->
<!--            <div class="column is-8 is-offset-2">-->
<!--              <form-->
<!--                action="https://formspree.io/email@example.com"-->
<!--                method="POST"-->
<!--              >-->
<!--                <div class="field">-->
<!--                  <label class="label">Name</label>-->
<!--                  <div class="control has-icons-left">-->
<!--                    <input-->
<!--                      class="input"-->
<!--                      type="text"-->
<!--                      placeholder="Ex. Adam Smasher"-->
<!--                      name="Name"-->
<!--                    />-->
<!--                    <span class="icon is-small is-left">-->
<!--                      <i class="fas fa-user"></i>-->
<!--                    </span>-->
<!--                  </div>-->
<!--                </div>-->
<!--                <div class="field">-->
<!--                  <label class="label">Email</label>-->
<!--                  <div class="control has-icons-left">-->
<!--                    <input-->
<!--                      class="input"-->
<!--                      type="email"-->
<!--                      placeholder="Ex. example@mail.com"-->
<!--                      name="Email"-->
<!--                    />-->
<!--                    <span class="icon is-small is-left">-->
<!--                      <i class="fas fa-envelope"></i>-->
<!--                    </span>-->
<!--                  </div>-->
<!--                </div>-->
<!--                <div class="field">-->
<!--                  <label class="label">Message</label>-->
<!--                  <div class="control">-->
<!--                    <textarea-->
<!--                      class="textarea"-->
<!--                      placeholder="Textarea"-->
<!--                      name="Message"-->
<!--                    ></textarea>-->
<!--                  </div>-->
<!--                </div>-->
<!--                <div class="field">-->
<!--                  <div class="control ">-->
<!--                    <button class="button submit-button">-->
<!--                      Submit&nbsp;&nbsp;-->
<!--                      <i class="fas fa-paper-plane"></i>-->
<!--                    </button>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </form>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

      <div class="section-light contact" id="contact">
        <div class="container">
          <div class="columns is-multiline" data-aos="fade-in-up" data-aos-easing="linear">
            <div class="column is-12 about-me">
              <h1 class="title has-text-centered section-title">Get in touch</h1>
            </div>
            <div class="column is-8 is-offset-2">
              <form id="contact-form">
                <div class="field">
                  <label class="label">Name</label>
                  <div class="control has-icons-left">
                    <input class="input" type="text" placeholder="Ex. Adam Smasher" name="name" />
                    <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
                  </div>
                </div>
                <div class="field">
                  <label class="label">Email</label>
                  <div class="control has-icons-left">
                    <input class="input" type="email" placeholder="Ex. example@mail.com" name="email" />
                    <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
              </span>
                  </div>
                </div>
                <div class="field">
                  <label class="label">Message</label>
                  <div class="control">
                    <textarea class="textarea" placeholder="Your message" name="message"></textarea>
                  </div>
                </div>
                <div class="field">
                  <div class="control">
                    <button type="submit" class="button submit-button">
                      Submit&nbsp;&nbsp;
                      <i class="fas fa-paper-plane"></i>
                    </button>
                  </div>
                </div>
              </form>
              <div id="form-message" class="notification is-hidden"></div>
            </div>
          </div>
        </div>
      </div>

    <div class="footer"> 
        <div class="columns"> 
  
          <div class="column has-text-centered has-text-white"> 
              <p>Copyright © CatFish</p> 
          </div>
  
          <div class="column"> 
            <h4 class="bd-footer-title  
                       has-text-weight-medium 
                       has-text-left
                       has-text-white"> 
              Schedule 
            </h4> 
            <p class="bd-footer-link  
                      has-text-left
                      has-text-white"> 
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                      Nullam sed sem ac lorem tincidunt placerat vel quis diam.
            </p> 
          </div> 
        
          <div class="column"> 
            <h4 class="bd-footer-title  
                       has-text-weight-medium  
                       has-text-justify
                       has-text-white"> 
              Address 
            </h4> 
            <p class="bd-footer-link has-text-white"> 
              MAI 33, Antananarivo 105, Madagaskar
            </p> 
        
          </div> 
        
          <div class="column"> 
            <h4 class="bd-footer-title 
                       has-text-weight-medium 
                       has-text-justify
                       has-text-white"> 
              Contact us 
            </h4> 
  
            <p class="bd-footer-link has-text-white"> 
                <p class="has-text-white">ContactUs@example.com</p>
                <p class="has-text-white">+261 34 05 024 91 </p>
              <a href="https://www.sancristobal.mg/">Web Page</a>
            </p> 
        
          </div> 
        </div> 
    </div> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/showcase.js"></script>
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <script>
      AOS.init({
        easing: "ease-out",
        duration: 800,
      });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          
          const burger = document.querySelector('.navbar-burger');
          const menu = document.querySelector('#navbarMenu');
          burger.addEventListener('click', () => {
            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
          });
        });
      </script>


    <script>
      document.getElementById('contact-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const formMessage = document.getElementById('form-message');


        fetch('/sendMessage', {
          method: 'POST',
          body: formData
        })
          .then(response => response.text())
          .then(text => {
            formMessage.className = 'notification is-success';
            formMessage.textContent = text;
            formMessage.classList.remove('is-hidden');
            form.reset();
          })
          .catch(error => {
            formMessage.className = 'notification is-danger';
            formMessage.textContent = 'There was an error sending your message. Please try again.';
            formMessage.classList.remove('is-hidden');
          });
      });
    </script>

  </body>
</html>