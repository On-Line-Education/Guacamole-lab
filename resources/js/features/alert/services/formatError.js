export function formatError(errorResponse) {
    switch (errorResponse) {
        case "Invalid Guacamole URL":
            return {
                title: "Błąd połączenia z serwerem Guacamole",
                message: "Skontaktuj się z administratorem",
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

        case "Class alredy has lecture at provided time range.":
            return {
                title: "Błąd tworzenia rezerwacji",
                message: "Ten termin jest już zajęty",
            };
        case "The username has already been taken.":
            return {
                title: "Błąd tworzenia użytkownika",
                message: "Ta nazwa użytkownika jest już zajęta",
            };

        default:
            return {
                title: "Wystąpił błąd",
                message: "",
            };
    }
}
