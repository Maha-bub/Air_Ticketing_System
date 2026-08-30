import React from 'react'
import { Head, Link } from '@inertiajs/react'
import Header from '@/Components/Parts/Header'
import PageHeader from "@/Components/Parts/PageHeader";
import Footer from '@/Components/Parts/Footer'

export default function About() {
    return (
        <>

            <div>
                <div className="page-wrapper">
                    <Head title="About Us" />
                    <Header />
                    <div className="stricky-header stricked-menu main-menu">
                        <div className="sticky-header__content" />{/* /.sticky-header__content */}
                    </div>{/* /.stricky-header */}
                    {/*Page Header Start*/}
                    <PageHeader title="About us" crumb="About" />
                    {/*Page Header End*/}
                    {/*About Four Start*/}
                    <section className="about-four">
                        <div className="container">
                            <div className="row">
                                <div className="col-xl-6 col-lg-6">
                                    <div className="about-four__left wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                                        <div className="about-four__img">
                                            <img src="/frontend-assets/images/resources/about-four-img-1.jpg" alt />
                                        </div>
                                    </div>
                                </div>
                                <div className="col-xl-6 col-lg-6">
                                    <div className="about-four__right">
                                        <div className="section-title text-left">
                                            <span className="section-title__tagline">About Company</span>
                                            <h2 className="section-title__title">The best private jet charters</h2>
                                        </div>
                                        <p className="about-four__text-1">There are many variations of passage of lorem available but
                                            the majority alteration.</p>
                                        <p className="about-four__text-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Curabitur condimentum, lacus non faucibus congue, lectus quam viverra nulla, quis
                                            egestas neque sapien ac magna. </p>
                                        <a href="/about" className="thm-btn about-four__btn">Dicover more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {/*About Four End*/}
                    {/*Counter Two Start*/}
                    <section className="counter-three">
                        <div className="counter-three__shape-1" style={{ backgroundImage: 'url(/frontend-assets/images/shapes/counter-three-shape-1.png)' }} />
                        <div className="container">
                            <ul className="list-unstyled counter-three__list">
                                <li className="counter-three__single wow fadeInUp" data-wow-delay="100ms">
                                    <div className="counter-three__count-box count-box">
                                        <h3 className="count-text" data-stop={395} data-speed={1500}>00</h3>
                                    </div>
                                    <p className="counter-three__text">Professional pilots</p>
                                </li>
                                <li className="counter-three__single wow fadeInUp" data-wow-delay="200ms">
                                    <div className="counter-three__count-box count-box">
                                        <h3 className="count-text" data-stop={166} data-speed={1500}>00</h3>
                                    </div>
                                    <p className="counter-three__text">Jet airplanes</p>
                                </li>
                                <li className="counter-three__single wow fadeInUp" data-wow-delay="300ms">
                                    <div className="counter-three__count-box count-box">
                                        <h3 className="count-text" data-stop={138} data-speed={1500}>00</h3>
                                    </div>
                                    <p className="counter-three__text">Directions</p>
                                </li>
                                <li className="counter-three__single wow fadeInUp" data-wow-delay="400ms">
                                    <div className="counter-three__count-box count-box">
                                        <h3 className="count-text" data-stop={280} data-speed={1500}>00</h3>
                                    </div>
                                    <p className="counter-three__text">World aiports</p>
                                </li>
                            </ul>
                        </div>
                    </section>
                    {/*Counter Two End*/}
                    {/*Testimonial One Start*/}
                    <section className="testimonial-one">
                        <div className="testimonial-one__shape-1 zoom-fade-2">
                            <img src="/frontend-assets/images/shapes/testimonial-shape-1.png" alt />
                        </div>
                        <div className="testimonial-one__shape-2 float-bob-x">
                            <img src="/frontend-assets/images/shapes/testimonial-shape-2.png" alt />
                        </div>
                        <div className="testimonial-one__shape-3 float-bob-x">
                            <img src="/frontend-assets/images/shapes/testimonial-shape-3.png" alt />
                        </div>
                        <div className="container">
                            <div className="section-title text-center">
                                <span className="section-title__tagline">customers feedback</span>
                                <h2 className="section-title__title">What they’re talking about <br /> our flight services</h2>
                            </div>
                            <div className="testimonial-one__bottom">
                                <div className="testimonial-one__shape-4" style={{ backgroundImage: 'url(/frontend-assets/images/shapes/testimonial-shape-4.png)' }} />
                                <div className="testimonial-one__carousel-grid" style={{ display: "grid", gridTemplateColumns: "repeat(auto-fit, minmax(320px, 1fr))", gap: "30px" }}>
                                    {/*Testimonial One Single Start*/}
                                    <div className="item">
                                        <div className="testimonial-one__single">
                                            <div className="testimonial-one__client-img-box">
                                                <div className="testimonial-one__img">
                                                    <img src="/frontend-assets/images/testimonial/testimonial-1-1.jpg" alt />
                                                    <div className="testimonial-one__icon-box">
                                                        <span className="icon-quote" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="testimonial-one__content">
                                                <p className="testimonial-one__content-text">There are many variations of passage of
                                                    available but the majority have suffered alteration in some form by injected
                                                    humor or randomed.</p>
                                                <div className="testimonial-one__rating">
                                                    <div className="testimonial-one__rating-icon">
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                    </div>
                                                    <div className="testimonial-one__user">
                                                        <div className="testimonial-one__user-name">
                                                            <h4>Bonnie tolbet</h4>
                                                            <p>Customer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {/*Testimonial One Single End*/}
                                    {/*Testimonial One Single Start*/}
                                    <div className="item">
                                        <div className="testimonial-one__single">
                                            <div className="testimonial-one__client-img-box">
                                                <div className="testimonial-one__img">
                                                    <img src="/frontend-assets/images/testimonial/testimonial-1-2.jpg" alt />
                                                    <div className="testimonial-one__icon-box">
                                                        <span className="icon-quote" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="testimonial-one__content">
                                                <p className="testimonial-one__content-text">There are many variations of passage of
                                                    available but the majority have suffered alteration in some form by injected
                                                    humor or randomed.</p>
                                                <div className="testimonial-one__rating">
                                                    <div className="testimonial-one__rating-icon">
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                    </div>
                                                    <div className="testimonial-one__user">
                                                        <div className="testimonial-one__user-name">
                                                            <h4>Sarah albert</h4>
                                                            <p>Customer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {/*Testimonial One Single End*/}
                                    {/*Testimonial One Single Start*/}
                                    <div className="item">
                                        <div className="testimonial-one__single">
                                            <div className="testimonial-one__client-img-box">
                                                <div className="testimonial-one__img">
                                                    <img src="/frontend-assets/images/testimonial/testimonial-1-3.jpg" alt />
                                                    <div className="testimonial-one__icon-box">
                                                        <span className="icon-quote" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="testimonial-one__content">
                                                <p className="testimonial-one__content-text">There are many variations of passage of
                                                    available but the majority have suffered alteration in some form by injected
                                                    humor or randomed.</p>
                                                <div className="testimonial-one__rating">
                                                    <div className="testimonial-one__rating-icon">
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                    </div>
                                                    <div className="testimonial-one__user">
                                                        <div className="testimonial-one__user-name">
                                                            <h4>Christine eve</h4>
                                                            <p>Customer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {/*Testimonial One Single End*/}
                                    {/*Testimonial One Single Start*/}
                                    <div className="item">
                                        <div className="testimonial-one__single">
                                            <div className="testimonial-one__client-img-box">
                                                <div className="testimonial-one__img">
                                                    <img src="/frontend-assets/images/testimonial/testimonial-1-4.jpg" alt />
                                                    <div className="testimonial-one__icon-box">
                                                        <span className="icon-quote" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="testimonial-one__content">
                                                <p className="testimonial-one__content-text">There are many variations of passage of
                                                    available but the majority have suffered alteration in some form by injected
                                                    humor or randomed.</p>
                                                <div className="testimonial-one__rating">
                                                    <div className="testimonial-one__rating-icon">
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                        <i className="fa fa-star" />
                                                    </div>
                                                    <div className="testimonial-one__user">
                                                        <div className="testimonial-one__user-name">
                                                            <h4>Jimmy smith</h4>
                                                            <p>Customer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {/*Testimonial One Single End*/}
                                </div>
                            </div>
                        </div>
                    </section>
                    {/*Testimonial One End*/}
                    {/*Video One Start*/}
                    <section className="video-one">
                        <div className="video-one__bg" style={{ backgroundImage: 'url(/frontend-assets/images/backgrounds/video-one-1.jpg)' }} />
                        <div className="container">
                            <div className="video-one__inner">
                                <div className="video-one__shape-one float-bob-x">
                                    <img src="/frontend-assets/images/shapes/video-one-shape-1.png" alt />
                                </div>
                                <div className="video-one__video-link">
                                    <a href="#" className="video-popup">
                                        <div className="video-one__video-icon">
                                            <span className="fa fa-play" />
                                            <i className="ripple" />
                                        </div>
                                    </a>
                                </div>
                                <div className="video-one__title-box">
                                    <h3>Share requirements and our <br /> charter experts will send you a quote</h3>
                                </div>
                                <div className="video-one__button">
                                    <div className="video-one__btn-one">
                                        <a href="/contact" className="thm-btn">Book Now</a>
                                    </div>
                                    <div className="video-one__btn-two">
                                        <a href="/about" className="thm-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {/*Video One End*/}
                    {/*Brand One Start*/}
                    <section className="brand-one brand-four">
                        <div className="container">
                            <div className="thm-swiper__slider swiper-container" data-swiper-options="{&quot;spaceBetween&quot;: 100,
          &quot;slidesPerView&quot;: 5,
          &quot;loop&quot;: true,
          &quot;navigation&quot;: {
              &quot;nextEl&quot;: &quot;#brand-one__swiper-button-next&quot;,
              &quot;prevEl&quot;: &quot;#brand-one__swiper-button-prev&quot;
          },
          &quot;autoplay&quot;: { &quot;delay&quot;: 5000 },
          &quot;breakpoints&quot;: {
              &quot;0&quot;: {
                  &quot;spaceBetween&quot;: 30,
                  &quot;slidesPerView&quot;: 2
              },
              &quot;375&quot;: {
                  &quot;spaceBetween&quot;: 30,
                  &quot;slidesPerView&quot;: 2
              },
              &quot;575&quot;: {
                  &quot;spaceBetween&quot;: 30,
                  &quot;slidesPerView&quot;: 3
              },
              &quot;767&quot;: {
                  &quot;spaceBetween&quot;: 50,
                  &quot;slidesPerView&quot;: 4
              },
              &quot;991&quot;: {
                  &quot;spaceBetween&quot;: 50,
                  &quot;slidesPerView&quot;: 5
              },
              &quot;1199&quot;: {
                  &quot;spaceBetween&quot;: 100,
                  &quot;slidesPerView&quot;: 5
              }
          }}">
                                <div className="swiper-wrapper">
                                    <div className="swiper-slide">
                                        <img src="/frontend-assets/images/brand/brand-1-1.png" alt />
                                    </div>{/* /.swiper-slide */}
                                    <div className="swiper-slide">
                                        <img src="/frontend-assets/images/brand/brand-1-2.png" alt />
                                    </div>{/* /.swiper-slide */}
                                    <div className="swiper-slide">
                                        <img src="/frontend-assets/images/brand/brand-1-3.png" alt />
                                    </div>{/* /.swiper-slide */}
                                    <div className="swiper-slide">
                                        <img src="/frontend-assets/images/brand/brand-1-4.png" alt />
                                    </div>{/* /.swiper-slide */}
                                    <div className="swiper-slide">
                                        <img src="/frontend-assets/images/brand/brand-1-5.png" alt />
                                    </div>{/* /.swiper-slide */}
                                    <div className="swiper-slide">
                                        <img src="/frontend-assets/images/brand/brand-1-1.png" alt />
                                    </div>{/* /.swiper-slide */}
                                    <div className="swiper-slide">
                                        <img src="/frontend-assets/images/brand/brand-1-2.png" alt />
                                    </div>{/* /.swiper-slide */}
                                    <div className="swiper-slide">
                                        <img src="/frontend-assets/images/brand/brand-1-3.png" alt />
                                    </div>{/* /.swiper-slide */}
                                    <div className="swiper-slide">
                                        <img src="/frontend-assets/images/brand/brand-1-4.png" alt />
                                    </div>{/* /.swiper-slide */}
                                    <div className="swiper-slide">
                                        <img src="/frontend-assets/images/brand/brand-1-5.png" alt />
                                    </div>{/* /.swiper-slide */}
                                </div>
                            </div>
                        </div>
                    </section>
                    {/*Brand One End*/}
                    {/*Team Start*/}
                    <section className="team">
                        <div className="container">
                            <div className="section-title text-center">
                                <span className="section-title__tagline">aircraft crew</span>
                                <h2 className="section-title__title">Meet the professional <br /> private jet crew</h2>
                            </div>
                            <div className="row">
                                {/*Team Single Start*/}
                                <div className="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                                    <div className="team__single">
                                        <div className="team__single-inner">
                                            <div className="team__img">
                                                <img src="/frontend-assets/images/team/team-1-1.jpg" alt />
                                            </div>
                                            <div className="team__content">
                                                <h4 className="team__name"><a href="/about">Jessica brown</a></h4>
                                                <p className="team__title">Senior pilot</p>
                                                <div className="team__social">
                                                    <a href="#"><i className="fab fa-twitter" /></a>
                                                    <a href="#"><i className="fab fa-facebook" /></a>
                                                    <a href="#"><i className="fab fa-pinterest-p" /></a>
                                                    <a href="#"><i className="fab fa-instagram" /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Team Single End*/}
                                {/*Team Single Start*/}
                                <div className="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                                    <div className="team__single">
                                        <div className="team__single-inner">
                                            <div className="team__img">
                                                <img src="/frontend-assets/images/team/team-1-2.jpg" alt />
                                            </div>
                                            <div className="team__content">
                                                <h4 className="team__name"><a href="/about">Mike hardson</a></h4>
                                                <p className="team__title">Service Manager</p>
                                                <div className="team__social">
                                                    <a href="#"><i className="fab fa-twitter" /></a>
                                                    <a href="#"><i className="fab fa-facebook" /></a>
                                                    <a href="#"><i className="fab fa-pinterest-p" /></a>
                                                    <a href="#"><i className="fab fa-instagram" /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Team Single End*/}
                                {/*Team Single Start*/}
                                <div className="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="300ms">
                                    <div className="team__single">
                                        <div className="team__single-inner">
                                            <div className="team__img">
                                                <img src="/frontend-assets/images/team/team-1-3.jpg" alt />
                                            </div>
                                            <div className="team__content">
                                                <h4 className="team__name"><a href="/about">Sarah albert</a></h4>
                                                <p className="team__title">Flight attendant</p>
                                                <div className="team__social">
                                                    <a href="#"><i className="fab fa-twitter" /></a>
                                                    <a href="#"><i className="fab fa-facebook" /></a>
                                                    <a href="#"><i className="fab fa-pinterest-p" /></a>
                                                    <a href="#"><i className="fab fa-instagram" /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Team Single End*/}
                            </div>
                        </div>
                    </section>
                    {/*Team End*/}
                    {/*Cta Start*/}
                    <section className="cta-one">
                        <div className="cta-one__bg-shape" style={{ backgroundImage: 'url(/frontend-assets/images/shapes/cta-one-bg-shape.png)' }}>
                        </div>
                        <div className="container">
                            <div className="cta-one__content">
                                <div className="cta-one__title">
                                    <h3>Save your time and fly with jetly</h3>
                                </div>
                                <div className="cta-one__btn-box">
                                    <a href="/contact" className="thm-btn cta-one__btn">call for booking</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    {/*Cta Start End*/}
                    {/*Site Footer Start*/}
                    <Footer />
                    {/*Site Footer End*/}
                </div>{/* /.page-wrapper */}
                {/* template js */}
            </div>

        </>
    )
}
