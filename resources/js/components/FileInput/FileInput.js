import React from "react";
import ImportIcon from "../../../assets/csv-import.png";
import "./fileinput.scss";

export default function FileInput({ setFile, setFileName, fileName }) {
    return (
        <div className="csv-input">
            <input
                type="file"
                accept=".csv"
                id="file"
                className="file-input-input"
                onChange={(e) => {
                    setFileName(e.target.files[0].name);
                    setFile(e.target.files[0]);
                }}
            />
            <label className="file-input-btn" htmlFor="file">
                <div className="file-name">{fileName}</div>
                <div className="file-choose">
                    <img src={ImportIcon} />
                </div>
            </label>
        </div>
    );
}
