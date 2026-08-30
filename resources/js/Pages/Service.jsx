import React from 'react'
import { Head, Link } from '@inertiajs/react'
import Header from '@/Components/Parts/Header'
import PageHeader from "@/Components/Parts/PageHeader";
import Footer from '@/Components/Parts/Footer'

export default function Service() {
    return (
        <>
            <div>
                <div className="page-wrapper">
                    <Head title="Our Services" />
                    <Header />
                    <div className="stricky-header stricked-menu main-menu">
                        <div className="sticky-header__content" />{/* /.sticky-header__content */}
                    </div>{/* /.stricky-header */}
                    {/*Page Header Start*/}
                    <PageHeader title="Our services" crumb="Services" />
                    {/*Page Header End*/}
                    {/*Services Page Start*/}
                    <section className="services-page">
                        <div className="container">
                            <div className="section-title text-center">
                                <span className="section-title__tagline">what we’re offering</span>
                                <h2 className="section-title__title">Select the service <br /> according to your work</h2>
                            </div>
                            <div className="row">
                                {/*Services One Single Start*/}
                                <div className="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                                    <div className="services-one__single">
                                        <div className="services-one__img">
                                            <img src="/frontend-assets/images/services/services-1-1.jpg" alt />
                                        </div>
                                        <div className="services-one__content">
                                            <div className="services-one__title-box">
                                                <span className="services-one__sub-title">Fight For</span>
                                                <h3 className="services-one__title"><a href="/service">Business charter</a>
                                                </h3>
                                            </div>
                                            <p className="services-one__text">Non augue egestas, commodo velit eget, tellus.</p>
                                            <div className="services-one__arrow">
                                                <a href="/service"><i className="fas fa-angle-right" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Services One Single End*/}
                                {/*Services One Single Start*/}
                                <div className="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                                    <div className="services-one__single">
                                        <div className="services-one__img">
                                            <img src="/frontend-assets/images/services/services-1-2.jpg" alt />
                                        </div>
                                        <div className="services-one__content">
                                            <div className="services-one__title-box">
                                                <span className="services-one__sub-title">Fight For</span>
                                                <h3 className="services-one__title"><a href="/service">Private charter</a>
                                                </h3>
                                            </div>
                                            <p className="services-one__text">Non augue egestas, commodo velit eget, tellus.</p>
                                            <div className="services-one__arrow">
                                                <a href="/service"><i className="fas fa-angle-right" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Services One Single End*/}
                                {/*Services One Single Start*/}
                                <div className="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                                    <div className="services-one__single">
                                        <div className="services-one__img">
                                            <img src="/frontend-assets/images/services/services-1-3.jpg" alt />
                                        </div>
                                        <div className="services-one__content">
                                            <div className="services-one__title-box">
                                                <span className="services-one__sub-title">Fight For</span>
                                                <h3 className="services-one__title"><a href="/service">Jet rentals</a></h3>
                                            </div>
                                            <p className="services-one__text">Non augue egestas, commodo velit eget, tellus.</p>
                                            <div className="services-one__arrow">
                                                <a href="/service"><i className="fas fa-angle-right" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Services One Single End*/}
                                {/*Services One Single Start*/}
                                <div className="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                                    <div className="services-one__single">
                                        <div className="services-one__img">
                                            <img src="/frontend-assets/images/services/services-1-4.jpg" alt />
                                        </div>
                                        <div className="services-one__content">
                                            <div className="services-one__title-box">
                                                <span className="services-one__sub-title">Fight For</span>
                                                <h3 className="services-one__title"><a href="/service">High profile
                                                    people</a></h3>
                                            </div>
                                            <p className="services-one__text">Non augue egestas, commodo velit eget, tellus.</p>
                                            <div className="services-one__arrow">
                                                <a href="/service"><i className="fas fa-angle-right" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Services One Single End*/}
                                {/*Services One Single Start*/}
                                <div className="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="500ms">
                                    <div className="services-one__single">
                                        <div className="services-one__img">
                                            <img src="/frontend-assets/images/services/services-1-5.jpg" alt />
                                        </div>
                                        <div className="services-one__content">
                                            <div className="services-one__title-box">
                                                <span className="services-one__sub-title">Fight For</span>
                                                <h3 className="services-one__title"><a href="/service">Music tours</a></h3>
                                            </div>
                                            <p className="services-one__text">Non augue egestas, commodo velit eget, tellus.</p>
                                            <div className="services-one__arrow">
                                                <a href="/service"><i className="fas fa-angle-right" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Services One Single End*/}
                                {/*Services One Single Start*/}
                                <div className="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="600ms">
                                    <div className="services-one__single">
                                        <div className="services-one__img">
                                            <img src="/frontend-assets/images/services/services-1-6.jpg" alt />
                                        </div>
                                        <div className="services-one__content">
                                            <div className="services-one__title-box">
                                                <span className="services-one__sub-title">Fight For</span>
                                                <h3 className="services-one__title"><a href="/service">Sports teams</a></h3>
                                            </div>
                                            <p className="services-one__text">Non augue egestas, commodo velit eget, tellus.</p>
                                            <div className="services-one__arrow">
                                                <a href="/service"><i className="fas fa-angle-right" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Services One Single End*/}
                            </div>
                        </div>
                    </section>
                    {/*Services Page End*/}
                    {/*Site Footer Start*/}
                    <Footer />
                    {/*Site Footer End*/}
                </div>{/* /.page-wrapper */}
                {/* template js */}
            </div>


        </>
    )
}
