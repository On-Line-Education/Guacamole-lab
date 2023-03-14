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

export default function SortingTable({
    selectRow,
    selectedRow,
    tableData,
    tableColumns,
}) {
    // cache data from api using useMemo react hook

    const columns = useMemo(() => tableColumns, []);
    const data = useMemo(() => tableData, []);

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
                                    className={column.name}
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
                                    row.original === selectedRow ? "active" : ""
                                }`}
                                onClick={() => {
                                    selectRow(row.original);
                                }}
                            >
                                {row.cells.map((cell) => {
                                    return (
                                        <td
                                            className={cell.column.name}
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
