import React from 'react'
import { Head, Link } from '@inertiajs/react'
import Header from '@/Components/Parts/Header'
import PageHeader from "@/Components/Parts/PageHeader";
import Footer from '@/Components/Parts/Footer'

export default function Gallery() {
    return (
        <>
            <div>
                <div className="page-wrapper">
                    <Head title="Gallery" />
                    <Header />
                    <div className="stricky-header stricked-menu main-menu">
                        <div className="sticky-header__content" />{/* /.sticky-header__content */}
                    </div>{/* /.stricky-header */}
                    {/*Page Header Start*/}
                    <PageHeader title="Gallery carousel" crumb="Gallery" />
                    {/*Page Header End*/}
                    {/*Gallery Page Start*/}
                    <section className="gallery-carousel-page">
                        <div className="container">
                            <div className="gallery-carousel-grid" style={{ display: "grid", gridTemplateColumns: "repeat(auto-fit, minmax(280px, 1fr))", gap: "30px" }}>
                                {/*Gallery Page Single Start*/}
                                <div className="item">
                                    <div className="gallery-page__single">
                                        <div className="gallery-page__img">
                                            <img src="/frontend-assets/images/gallery/gallery-page-1.jpg" alt />
                                            <div className="gallery-page__icon">
                                                <a className="img-popup" href="/frontend-assets/images/gallery/gallery-page-1.jpg"><span className="fa fa-plus" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Gallery Page Single End*/}
                                {/*Gallery Page Single Start*/}
                                <div className="item">
                                    <div className="gallery-page__single">
                                        <div className="gallery-page__img">
                                            <img src="/frontend-assets/images/gallery/gallery-page-2.jpg" alt />
                                            <div className="gallery-page__icon">
                                                <a className="img-popup" href="/frontend-assets/images/gallery/gallery-page-2.jpg"><span className="fa fa-plus" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Gallery Page Single End*/}
                                {/*Gallery Page Single Start*/}
                                <div className="item">
                                    <div className="gallery-page__single">
                                        <div className="gallery-page__img">
                                            <img src="/frontend-assets/images/gallery/gallery-page-3.jpg" alt />
                                            <div className="gallery-page__icon">
                                                <a className="img-popup" href="/frontend-assets/images/gallery/gallery-page-3.jpg"><span className="fa fa-plus" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Gallery Page Single End*/}
                                {/*Gallery Page Single Start*/}
                                <div className="item">
                                    <div className="gallery-page__single">
                                        <div className="gallery-page__img">
                                            <img src="/frontend-assets/images/gallery/gallery-page-4.jpg" alt />
                                            <div className="gallery-page__icon">
                                                <a className="img-popup" href="/frontend-assets/images/gallery/gallery-page-4.jpg"><span className="fa fa-plus" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Gallery Page Single End*/}
                                {/*Gallery Page Single Start*/}
                                <div className="item">
                                    <div className="gallery-page__single">
                                        <div className="gallery-page__img">
                                            <img src="/frontend-assets/images/gallery/gallery-page-5.jpg" alt />
                                            <div className="gallery-page__icon">
                                                <a className="img-popup" href="/frontend-assets/images/gallery/gallery-page-5.jpg"><span className="fa fa-plus" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Gallery Page Single End*/}
                                {/*Gallery Page Single Start*/}
                                <div className="item">
                                    <div className="gallery-page__single">
                                        <div className="gallery-page__img">
                                            <img src="/frontend-assets/images/gallery/gallery-page-6.jpg" alt />
                                            <div className="gallery-page__icon">
                                                <a className="img-popup" href="/frontend-assets/images/gallery/gallery-page-6.jpg"><span className="fa fa-plus" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Gallery Page Single End*/}
                                {/*Gallery Page Single Start*/}
                                <div className="item">
                                    <div className="gallery-page__single">
                                        <div className="gallery-page__img">
                                            <img src="/frontend-assets/images/gallery/gallery-page-7.jpg" alt />
                                            <div className="gallery-page__icon">
                                                <a className="img-popup" href="/frontend-assets/images/gallery/gallery-page-7.jpg"><span className="fa fa-plus" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Gallery Page Single End*/}
                                {/*Gallery Page Single Start*/}
                                <div className="item">
                                    <div className="gallery-page__single">
                                        <div className="gallery-page__img">
                                            <img src="/frontend-assets/images/gallery/gallery-page-8.jpg" alt />
                                            <div className="gallery-page__icon">
                                                <a className="img-popup" href="/frontend-assets/images/gallery/gallery-page-8.jpg"><span className="fa fa-plus" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Gallery Page Single End*/}
                                {/*Gallery Page Single Start*/}
                                <div className="item">
                                    <div className="gallery-page__single">
                                        <div className="gallery-page__img">
                                            <img src="/frontend-assets/images/gallery/gallery-page-9.jpg" alt />
                                            <div className="gallery-page__icon">
                                                <a className="img-popup" href="/frontend-assets/images/gallery/gallery-page-9.jpg"><span className="fa fa-plus" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/*Gallery Page Single End*/}
                            </div>
                        </div>
                    </section>
                    {/*Gallery Page End*/}
                    {/*Site Footer Start*/}
                    <Footer />
                    {/*Site Footer End*/}
                </div>{/* /.page-wrapper */}
                {/* template js */}
            </div>

        </>
    )
}
