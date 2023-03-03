import React, { useMemo } from "react";
import { useTable, useRowSelect } from "react-table";
import "./basictable.scss";

export default function BasicTable({ MOCKDATA, selectRow, selectedRow }) {
    // cache data from api using useMemo react hook

    const columns = useMemo(() => MOCKDATA.COLUMNS, []);
    const data = useMemo(() => MOCKDATA.DATA, []);

    // create table instance using react-table library, for more check official react-table documentation

    const {
        getTableProps,
        getTableBodyProps,
        headerGroups,
        rows,
        prepareRow,
        state,
    } = useTable(
        {
            columns,
            data,
        },
        useRowSelect
    );

    return (
        <div className="table-container">
            <table {...getTableProps()} className="basic-table">
                {/* <thead>
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
                                    </div>
                                </th>
                            ))}
                        </tr>
                    ))}
                </thead> */}
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
                                            className={`table-cell ${cell.column.id}`}
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
