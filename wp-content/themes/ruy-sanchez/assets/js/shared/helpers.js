export const isPasswordFormatValid = (pass) => {
    // Minimum 8 characters, at least one letter, one number and one special char
    return /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#.,?&])[A-Za-z\d@$!%*#_.?&]{8,}$/.test(pass)
}

export const isEmailValid = (email) => {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}