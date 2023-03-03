import SearchIcon from "@mui/icons-material/Search";
import React from "react";

export default function GlobalFilter({ filter, setFilter }) {
    return (
        <div style={{ display: "flex", alignItems: "center" }}>
            <SearchIcon fontSize="small" />
            <input
                className="guac-table-input"
                id="filter"
                placeholder="Szukaj"
                value={filter || ""}
                onChange={(e) => setFilter(e.target.value)}
            />
        </div>
    );
}
