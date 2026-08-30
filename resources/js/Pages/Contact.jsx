import React from 'react'
import { Head, Link, useForm, usePage } from '@inertiajs/react'
import Header from '@/Components/Parts/Header'
import PageHeader from "@/Components/Parts/PageHeader";
import Footer from '@/Components/Parts/Footer'

export default function Contact() {
    const { props } = usePage();
    const flashSuccess = props?.flash?.success;

    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        phone: '',
        subject: '',
        message: '',
    });

    function submit(e) {
        e.preventDefault();
        post('/contact', {
            preserveScroll: true,
            onSuccess: () => reset(),
        });
    }

    return (
        <>
            <div>
                <div className="page-wrapper">
                    <Head title="Contact Us" />
                    <Header />
                    <div className="stricky-header stricked-menu main-menu">
                        <div className="sticky-header__content" />{/* /.sticky-header__content */}
                    </div>{/* /.stricky-header */}
                    {/*Page Header Start*/}
                    <PageHeader title="Contact us" crumb="Contact" />
                    {/*Page Header End*/}
                    {/*Contact Page Start*/}
                    <section className="contact-page">
                        <div className="container">
                            <div className="section-title text-center">
                                <span className="section-title__tagline">contact us</span>
                                <h2 className="section-title__title">Feel free to get in touch <br /> with the jetly</h2>
                            </div>
                            <div className="row">
                                {/*Contact Page Single Start*/}
                                <div className="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                                    <div className="contact-page__single">
                                        <div className="contact-page__title-box">
                                            <div className="contact-page__title">
                                                <span>know</span>
                                                <h3>About us</h3>
                                            </div>
                                            <div className="contact-page__icon">
                                                <span className="icon-flight-1" />
                                            </div>
                                        </div>
                                        <p className="contact-page__text">Non augue egestas, commodo velit eget, tellus.</p>
                                    </div>
                                </div>
                                {/*Contact Page Single End*/}
                                {/*Contact Page Single Start*/}
                                <div className="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                                    <div className="contact-page__single">
                                        <div className="contact-page__title-box">
                                            <div className="contact-page__title">
                                                <span>write</span>
                                                <h3>Send email</h3>
                                            </div>
                                            <div className="contact-page__icon">
                                                <span className="icon-envelope-back" />
                                            </div>
                                        </div>
                                        <p className="contact-page__text">
                                            <a href="mailto:needhelp@company.com">needhelp@company.com</a>
                                            <a href="mailto:info@comapny.com">info@comapny.com</a>
                                        </p>
                                    </div>
                                </div>
                                {/*Contact Page Single End*/}
                                {/*Contact Page Single Start*/}
                                <div className="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="300ms">
                                    <div className="contact-page__single">
                                        <div className="contact-page__title-box">
                                            <div className="contact-page__title">
                                                <span>book</span>
                                                <h3>Call now</h3>
                                            </div>
                                            <div className="contact-page__icon contact-page__icon--last">
                                                <span className="icon-call" />
                                            </div>
                                        </div>
                                        <p className="contact-page__text">
                                            <a href="tel:9288006780">+92 ( 8800 ) - 6780</a>
                                            <a href="tel:0066680900">Jetly + 00 66680 900</a>
                                        </p>
                                    </div>
                                </div>
                                {/*Contact Page Single End*/}
                            </div>
                        </div>
                    </section>
                    {/*Contact Page End*/}
                    {/*Contact One Start*/}
                    <section className="contact-one">
                        <div className="container">
                            {flashSuccess && (
                                <div className="alert alert-success mb-4">{flashSuccess}</div>
                            )}
                            <div className="contact-one__form-box">
                                <form onSubmit={submit} className="contact-one__form contact-form-validated" noValidate="novalidate">
                                    <div className="row">
                                        <div className="col-xl-6">
                                            <div className="contact-form__input-box">
                                                <input type="text" placeholder="Your name" name="name"
                                                    value={data.name}
                                                    onChange={(e) => setData("name", e.target.value)} />
                                                {errors.name && <small className="text-danger">{errors.name}</small>}
                                            </div>
                                        </div>
                                        <div className="col-xl-6">
                                            <div className="contact-form__input-box">
                                                <input type="email" placeholder="Email address" name="email"
                                                    value={data.email}
                                                    onChange={(e) => setData("email", e.target.value)} />
                                                {errors.email && <small className="text-danger">{errors.email}</small>}
                                            </div>
                                        </div>
                                        <div className="col-xl-6">
                                            <div className="contact-form__input-box">
                                                <input type="text" placeholder="Phone number" name="phone"
                                                    value={data.phone}
                                                    onChange={(e) => setData("phone", e.target.value)} />
                                                {errors.phone && <small className="text-danger">{errors.phone}</small>}
                                            </div>
                                        </div>
                                        <div className="col-xl-6">
                                            <div className="contact-form__input-box">
                                                <input type="text" placeholder="Subject" name="subject"
                                                    value={data.subject}
                                                    onChange={(e) => setData("subject", e.target.value)} />
                                                {errors.subject && <small className="text-danger">{errors.subject}</small>}
                                            </div>
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col-xl-12">
                                            <div className="contact-form__input-box text-message-box">
                                                <textarea name="message" placeholder="Write message"
                                                    value={data.message}
                                                    onChange={(e) => setData("message", e.target.value)} />
                                                {errors.message && <small className="text-danger">{errors.message}</small>}
                                            </div>
                                            <div className="contact-form__btn-box">
                                                <button type="submit" className="thm-btn contact-form__btn" disabled={processing}>
                                                    {processing ? "Sending..." : "Send a message"}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                    {/*Contact One End*/}
                    {/*Google Map Start*/}
                    <section className="google-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4562.753041141002!2d-118.80123790098536!3d34.152323469614075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80e82469c2162619%3A0xba03efb7998eef6d!2sCostco+Wholesale!5e0!3m2!1sbn!2sbd!4v1562518641290!5m2!1sbn!2sbd" className="google-map__one" allowFullScreen />
                    </section>
                    {/*Google Map End*/}
                    {/*Site Footer Start*/}
                    <Footer />
                    {/*Site Footer End*/}
                </div>{/* /.page-wrapper */}
                {/* template js */}
            </div>

        </>
    )
}
