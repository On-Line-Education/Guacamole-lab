import SortByAlphaIcon from "@mui/icons-material/SortByAlpha";
import GlobalFilter from "./GlobalFilter";
import React, { useMemo, useEffect } from "react";
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
    externalFilter,
    numbered = false,
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

    useEffect(() => {
        if (externalFilter) {
            setGlobalFilter(externalFilter);
        }
    }, [externalFilter]);

    if (tableData.length < 1) return "Brak elementów do wyświetlenia";

    return (
        <div className="table-container">
            <table {...getTableProps()} className="sorting-table">
                <thead>
                    {headerGroups.map((headerGroup) => (
                        <tr {...headerGroup.getHeaderGroupProps()}>
                            {numbered ? (
                                <th className="id">
                                    <div className="col-flex">Lp</div>
                                </th>
                            ) : (
                                ""
                            )}
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
                                                className="table-button"
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
                    {rows.map((row, i) => {
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
                                {numbered ? (
                                    <td className="id">{i + 1}</td>
                                ) : (
                                    ""
                                )}
                                {row.cells.map((cell) => {
                                    return (
                                        <td
                                            className={cell.column.name}
                                            {...cell.getCellProps()}
                                        >
                                            {cell.column.destructureClass
                                                ? cell.value
                                                      .map((item) => {
                                                          if (item) {
                                                              return item.name;
                                                          }
                                                      })
                                                      .join(", ")
                                                : cell.value}
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
