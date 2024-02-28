import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    enabled: process.env.NODE_ENV === "production",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                welcome:
                    "url('https://images.unsplash.com/photo-1707056790571-54d8612d6368?q=80&w=1160&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')",
            },
            colors: {
                "regal-blue": "#243c5a",
            },
            animation: {
                fade: "fadeIn .5s ease-in forwards",
            },
            keyframes: (theme) => ({
                fadeIn: {
                    "0%": { backgroundColor: theme("colors.transparent") },
                    "100%": { backgroundColor: theme("colors.black") },
                },
            }),
            height: {
                128: "48rem",
            },
            backgroundImage: {
                uni: "url('https://visitwalesimages.thedms.co.uk/propertypics/MW/vlarge/0926720__9.jpg')",
                happy_student:
                    "url('https://thumbs.dreamstime.com/b/happy-german-female-student-group-computer-science-students-happy-german-female-student-group-computer-science-176998474.jpg')",
                happy_helper:
                    "url('https://thumbs.dreamstime.com/b/positive-classmates-smiling-looking-screen-pc-learning-computer-science-classroom-happy-students-enjoying-263549346.jpg')",
            },
        },
    },

    plugins: [forms],
};
