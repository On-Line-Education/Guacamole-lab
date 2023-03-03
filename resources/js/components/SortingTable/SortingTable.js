import SortByAlphaIcon from "@mui/icons-material/SortByAlpha";
import GlobalFilter from "./GlobalFilter";
import React, { useMemo, useState } from "react";
import {
    useTable,
    useSortBy,
    useGlobalFilter,
    useRowSelect,
} from "react-table";
import "./sortingtable.scss";
import { IconButton } from "@mui/material";

export default function GuacamoleSoringTable({ selectRow, selectedRow }) {
    // TESTING DATA
    const MOCKDATA = [
        {
            id: 1,
            username: "amacpake0",
            group: "1tc",
        },
        {
            id: 2,
            username: "hdenizet1",
            group: "4la",
        },
        {
            id: 3,
            username: "lharwell2",
            group: "4ta",
        },
        {
            id: 4,
            username: "ymacfadzean3",
            group: "1gtb",
        },
        {
            id: 5,
            username: "cwiltshear4",
            group: "1gtb",
        },
        {
            id: 6,
            username: "bmccrorie5",
            group: "1tc",
        },
        {
            id: 7,
            username: "bkruschov6",
            group: "4la",
        },
        {
            id: 8,
            username: "keric7",
            group: "1gta",
        },
        {
            id: 9,
            username: "tdomenge8",
            group: "1gta",
        },
        {
            id: 10,
            username: "bmereweather9",
            group: "1tc",
        },
        {
            id: 10,
            username: "bmereweather9",
            group: "1tc",
        },
    ];

    const COLUMNS = [
        {
            Header: "Id",
            accessor: "id",
            disableSortBy: true,
        },
        {
            Header: "Username",
            accessor: "username",
        },
        {
            Header: "Groups",
            accessor: "group",
            disableSortBy: true,
            Filter: true,
        },
    ];

    // cache data from api using useMemo react hook

    const columns = useMemo(() => COLUMNS, []);
    const data = useMemo(() => MOCKDATA, []);

    // create table instance using react-table library, for more check official react-table documentation

    const {
        getTableProps,
        getTableBodyProps,
        headerGroups,
        rows,
        prepareRow,
        state,
        setGlobalFilter,
    } = useTable(
        {
            columns,
            data,
        },
        useGlobalFilter,
        useSortBy,
        useRowSelect
    );

    const { globalFilter } = state;

    return (
        <div className="table-container">
            <table {...getTableProps()} className="sorting-table">
                <thead>
                    {headerGroups.map((headerGroup) => (
                        <tr {...headerGroup.getHeaderGroupProps()}>
                            {headerGroup.headers.map((column) => (
                                <th
                                    id={column.id}
                                    className={column.id}
                                    {...column.getHeaderProps()}
                                >
                                    <div className="col-flex">
                                        {column.render("Header")}
                                        {column.Filter ? (
                                            <GlobalFilter
                                                filter={globalFilter}
                                                setFilter={setGlobalFilter}
                                            />
                                        ) : (
                                            ""
                                        )}
                                        {!column.disableSortBy ? (
                                            <IconButton
                                                size="small"
                                                onClick={() =>
                                                    column.toggleSortBy()
                                                }
                                            >
                                                <SortByAlphaIcon
                                                    fontSize="small"
                                                    color="primary"
                                                />
                                            </IconButton>
                                        ) : (
                                            ""
                                        )}
                                    </div>
                                </th>
                            ))}
                        </tr>
                    ))}
                </thead>
                <tbody {...getTableBodyProps()}>
                    {rows.map((row) => {
                        prepareRow(row);
                        return (
                            <tr
                                {...row.getRowProps()}
                                className={`table-row ${
                                    row.id === selectedRow ? "active" : ""
                                }`}
                                onClick={() => {
                                    selectRow(row.id);
                                }}
                            >
                                {row.cells.map((cell) => {
                                    return (
                                        <td
                                            className={cell.column.id}
                                            {...cell.getCellProps()}
                                        >
                                            {cell.render("Cell")}
                                        </td>
                                    );
                                })}
                            </tr>
                        );
                    })}
                </tbody>
            </table>
        </div>
    );
}
