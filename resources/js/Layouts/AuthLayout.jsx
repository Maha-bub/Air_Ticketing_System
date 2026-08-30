import { Link } from '@inertiajs/react';

export default function AuthLayout({ title, subtitle, children }) {
    return (
        <div className="auth-page">
            <div className="auth-card">
                <div className="auth-card__header">
                    <h1>{title}</h1>
                    {subtitle && <p>{subtitle}</p>}
                </div>
                <div className="auth-card__body">{children}</div>
            </div>

            <Link href="/" className="auth-back-home">
                &larr; Back to homepage
            </Link>
        </div>
    );
}
