import { createTheme, styled } from "@mui/material/styles";
import Button from "@mui/material/Button";
import { Select, TextField } from "@mui/material";
import { DatePicker, DateTimePicker, TimePicker } from "@mui/x-date-pickers";

const muiTheme = createTheme({
    palette: {
        primary: {
            main: "#2B272A",
            light: "#F3F2ED",
        },
        secondary: {
            main: "#EDFFA9",
        },
        error: {
            main: "#C61402",
        },
    },
    typography: {
        title: {
            fontFamily: '"Raleway", sans-serif',
            fontWeight: 500,
        },
        content: {
            fontFamily: '"Inter", arial',
            fontWeight: 700,
        },
    },
});

export const GuacamoleButton = styled(Button)(({ theme }) => ({
    height: "2.75em",
    width: "100%",
    color: theme.palette.primary.main,
    backgroundColor: theme.palette.secondary.main,
    boxShadow: "none",
    textTransform: "none",
    fontFamily: theme.typography.content.fontFamily,
    fontWeight: theme.typography.content.fontWeight,
    "&:disabled": {
        backgroundColor: theme.palette.primary.light,
    },
}));

export const GuacamoleFragileButton = styled(Button)(({ theme }) => ({
    height: "2.75em",
    width: "100%",
    color: theme.palette.primary.light,
    backgroundColor: theme.palette.error.main,
    boxShadow: "none",
    textTransform: "none",
    fontFamily: theme.typography.content.fontFamily,
    fontWeight: theme.typography.content.fontWeight,
    "&:hover": {
        backgroundColor: theme.palette.primary.main,
    },
    "&:disabled": {
        backgroundColor: theme.palette.primary.light,
    },
}));

export const GuacamoleInput = styled(TextField)(({ theme }) => ({
    boxShadow: "none",
    border: "1px solid",
    height: "2.75em",
    width: "100%",
    color: theme.palette.primary.main,
    fontFamily: theme.typography.content.fontFamily,
    borderColor: theme.palette.primary.main,
    borderRadius: "5px",
}));

export const GuacamoleDateTimePicker = styled(DateTimePicker)(({ theme }) => ({
    boxShadow: "none",
    border: "1px solid",
    height: "2.75em",
    width: "100%",
    color: theme.palette.primary.main,
    fontFamily: theme.typography.content.fontFamily,
    borderColor: theme.palette.primary.main,
    borderRadius: "5px",
}));

export const GuacamoleDatePicker = styled(DatePicker)(({ theme }) => ({
    boxShadow: "none",
    border: "1px solid",
    height: "2.75em",
    width: "100%",
    color: theme.palette.primary.main,
    fontFamily: theme.typography.content.fontFamily,
    borderColor: theme.palette.primary.main,
    borderRadius: "5px",
}));

export const GuacamoleTimePicker = styled(TimePicker)(({ theme }) => ({
    boxShadow: "none",
    border: "1px solid",
    height: "2.75em",
    width: "100%",
    color: theme.palette.primary.main,
    fontFamily: theme.typography.content.fontFamily,
    borderColor: theme.palette.primary.main,
    borderRadius: "5px",
}));

export const GuacamoleSelect = styled(Select)(({ theme }) => ({
    boxShadow: "none",
    border: "1px solid",
    height: "2.75em",
    width: "100%",
    color: theme.palette.primary.main,
    fontFamily: theme.typography.content.fontFamily,
    borderColor: theme.palette.primary.main,
    borderRadius: "5px",
}));

export default muiTheme;
