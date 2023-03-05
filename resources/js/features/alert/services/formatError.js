export function formatError(errorResponse) {
    switch (errorResponse) {
        case "The password field is required.":
            return {
                type: "login",
                code: "REQUIRED_PASSWORD",
                title: "Błąd logowania",
                message: "Pole hasła nie może być puste",
            };
        case "The username field is required.":
            return {
                type: "login",
                code: "REQUIRED_USERNAME",
                title: "Błąd logowania",
                message: "Pole nazwy użytkownika nie może być puste",
            };
        case "The password must be at least 8 characters.":
            return {
                type: "login",
                code: "PASSWORD_TOO_SHORT",
                title: "Błąd logowania",
                message: "Hasło musi mieć co najmniej 8 znaków",
            };
        case "Invalid credentials":
            return {
                type: "login",
                code: "PASSWORD_TOO_SHORT",
                title: "Błąd logowania",
                message: "Nieprawidłowe dane",
            };
        case "Session expired":
            return {
                type: "auth",
                code: "SESSION_EXPIRED",
                title: "Sesja wygasła",
                message: "Zaloguj się ponownie",
            };
        default:
            return {
                type: "unknown",
                code: "unknown",
                title: "Wystąpił błąd",
                message: "",
            };
    }
}
