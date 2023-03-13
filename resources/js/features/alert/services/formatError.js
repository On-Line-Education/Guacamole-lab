export function formatError(errorResponse) {
    switch (errorResponse) {
        case "Invalid Guacamole URL":
            return {
                title: "Błąd połączenia",
                message: "Spróbuj ponownie później",
            };
        case "The password field is required.":
            return {
                title: "Błąd logowania",
                message: "Pole hasła nie może być puste",
            };
        case "The username field is required.":
            return {
                title: "Błąd logowania",
                message: "Pole nazwy użytkownika nie może być puste",
            };
        case "The password must be at least 8 characters.":
            return {
                title: "Błąd logowania",
                message: "Hasło musi mieć co najmniej 8 znaków",
            };
        case "Invalid credentials":
            return {
                title: "Błąd logowania",
                message: "Nieprawidłowe dane",
            };
        case "Session expired":
            return {
                title: "Sesja wygasła",
                message: "Zaloguj się ponownie",
            };
        case "The import csv field is required.":
            return {
                title: "Błąd podczas importu",
                message: "Pole CSV nie może być puste",
            };
        case "Classroom already exists.":
            return {
                title: "Błąd tworzenia klasy",
                message: "Klasa już istnieje",
            };
        default:
            return {
                title: "Wystąpił błąd",
                message: "",
            };
    }
}
