import AuthLayout from '@/Layouts/AuthLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    const errorMessages = Object.values(errors).flat();

    return (
        <AuthLayout
            title="Welcome Back"
            subtitle="Sign in to continue booking your flight"
        >
            <Head title="Log in" />

            {status && <div className="auth-status">{status}</div>}

            {errorMessages.length > 0 && (
                <div className="auth-alert">
                    <ul>
                        {errorMessages.map((message, index) => (
                            <li key={index}>{message}</li>
                        ))}
                    </ul>
                </div>
            )}

            <form onSubmit={submit}>
                <div className="auth-field">
                    <label htmlFor="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        autoComplete="username"
                        autoFocus
                        required
                        onChange={(e) => setData('email', e.target.value)}
                    />
                </div>

                <div className="auth-field">
                    <label htmlFor="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        autoComplete="current-password"
                        required
                        onChange={(e) => setData('password', e.target.value)}
                    />
                </div>

                <div className="auth-row-between">
                    <label>
                        <input
                            type="checkbox"
                            name="remember"
                            checked={data.remember}
                            onChange={(e) =>
                                setData('remember', e.target.checked)
                            }
                        />
                        Remember me
                    </label>

                    {canResetPassword && (
                        <Link href={route('password.request')}>
                            Forgot password?
                        </Link>
                    )}
                </div>

                <button
                    type="submit"
                    className="auth-submit"
                    disabled={processing}
                >
                    {processing ? 'Signing in...' : 'Log In'}
                </button>

                <p className="auth-footer-text">
                    Don&apos;t have an account?{' '}
                    <Link href={route('register')}>Register here</Link>
                </p>
            </form>
        </AuthLayout>
    );
}
