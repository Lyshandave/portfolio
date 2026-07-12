import { Link } from "@inertiajs/react";
import { useEffect, useState } from "react";

export default function CaseStudy({ profile, project }) {
    const currentYear = new Date().getFullYear();
    const [selectedShowcaseImage, setSelectedShowcaseImage] = useState(null);

    useEffect(() => {
        if (window.initializeGlobalAnimations)
            window.initializeGlobalAnimations();
    }, []);

    // Close modal on escape key
    useEffect(() => {
        const handleKeyDown = (e) => {
            if (e.key === "Escape") setSelectedShowcaseImage(null);
        };
        window.addEventListener("keydown", handleKeyDown);
        return () => window.removeEventListener("keydown", handleKeyDown);
    }, []);

    // Helper to render icon for tech stacks or standard items if needed
    const getTechIcon = (tech) => {
        const lowerTech = tech.toLowerCase();
        if (lowerTech.includes("laravel")) return "fab fa-laravel text-red-500";
        if (lowerTech.includes("react")) return "fab fa-react text-sky-400";
        if (lowerTech.includes("vue")) return "fab fa-vuejs text-emerald-500";
        if (lowerTech.includes("php")) return "fab fa-php text-indigo-400";
        if (lowerTech.includes("js") || lowerTech.includes("javascript"))
            return "fab fa-js text-yellow-500";
        if (lowerTech.includes("ts") || lowerTech.includes("typescript"))
            return "fas fa-code text-blue-500";
        if (lowerTech.includes("node")) return "fab fa-node-js text-green-500";
        if (lowerTech.includes("python")) return "fab fa-python text-blue-400";
        if (
            lowerTech.includes("postgres") ||
            lowerTech.includes("sql") ||
            lowerTech.includes("db")
        )
            return "fas fa-database text-slate-500";
        if (lowerTech.includes("tailwind"))
            return "fab fa-css3-alt text-teal-400";
        if (lowerTech.includes("cisco") || lowerTech.includes("packet"))
            return "fas fa-network-wired text-blue-500";
        return "fas fa-check-circle text-indigo-500";
    };

    return (
        <>
            <title>
                {project.title} Case Study | {profile.name}
            </title>
            <meta
                name="description"
                content={project.subtitle || project.description}
            />
            <meta name="author" content={profile.name} />

            <style>{`
                body { font-family: 'Instrument Sans', sans-serif; }
                .display-font { font-family: 'Space Grotesk', 'Instrument Sans', sans-serif; }
            `}</style>

            {/* Background Decorative Blobs Container */}
            <div
                className={[
                    "fixed",
                    "inset-0",
                    "overflow-hidden",
                    "pointer-events-none",
                    "z-0",
                    "dark:hidden",
                ].join(" ")}
            >
                <div
                    className={[
                        "absolute",
                        "top-[-10%]",
                        "left-[-10%]",
                        "w-[50vw]",
                        "h-[50vw]",
                        "rounded-full",
                        "bg-indigo-400/10",
                        "blur-[120px]",
                    ].join(" ")}
                ></div>
                <div
                    className={[
                        "absolute",
                        "bottom-[-10%]",
                        "right-[-10%]",
                        "w-[50vw]",
                        "h-[50vw]",
                        "rounded-full",
                        "bg-emerald-400/10",
                        "blur-[120px]",
                    ].join(" ")}
                ></div>
            </div>

            <div
                id="app-container"
                className={[
                    "max-w-5xl",
                    "mx-auto",
                    "px-4",
                    "pt-8",
                    "pb-4",
                    "relative",
                    "z-10",
                    "flex",
                    "flex-col",
                    "min-h-screen",
                ].join(" ")}
            >
                {/* HEADER NAVIGATION */}
                <header
                    className={["mb-8", "flex", "flex-col", "items-start"].join(
                        " ",
                    )}
                >
                    <Link
                        href="/projects"
                        prefetch={["mount", "hover"]}
                        className={[
                            "inline-flex",
                            "items-center",
                            "gap-1.5",
                            "text-xs",
                            "text-slate-500",
                            "hover:text-indigo-500",
                            "font-semibold",
                            "transition-colors",
                            "cursor-pointer",
                        ].join(" ")}
                        aria-label="Back to projects"
                    >
                        <i
                            className={[
                                "fas",
                                "fa-arrow-left",
                                "text-[10px]",
                            ].join(" ")}
                        ></i>
                        <span>View All Projects</span>
                    </Link>

                    <div
                        className={[
                            "w-full",
                            "flex",
                            "flex-col",
                            "sm:flex-row",
                            "sm:items-center",
                            "sm:justify-between",
                            "gap-4",
                            "mt-4",
                        ].join(" ")}
                    >
                        <div className={["space-y-1.5", "max-w-2xl"].join(" ")}>
                            <h1
                                className={[
                                    "text-2xl",
                                    "md:text-4xl",
                                    "font-bold",
                                    "text-slate-900",
                                    "dark:text-white",
                                    "display-font",
                                ].join(" ")}
                            >
                                {project.title}
                            </h1>
                            <p
                                className={[
                                    "text-sm",
                                    "md:text-base",
                                    "text-slate-600",
                                    "dark:text-slate-400",
                                    "leading-relaxed",
                                    "font-medium",
                                ].join(" ")}
                            >
                                {project.subtitle || project.description}
                            </p>
                        </div>
                        <div
                            className={[
                                "flex",
                                "flex-wrap",
                                "gap-2",
                                "self-start",
                                "sm:self-center",
                            ].join(" ")}
                        >
                            {project.demo && (
                                <a
                                    href={project.demo}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className={[
                                        "inline-flex",
                                        "h-9",
                                        "items-center",
                                        "justify-center",
                                        "rounded-lg",
                                        "bg-indigo-600",
                                        "hover:bg-indigo-500",
                                        "px-4",
                                        "text-xs",
                                        "font-bold",
                                        "text-white",
                                        "gap-1.5",
                                        "cursor-pointer",
                                        "border-b-2",
                                        "border-indigo-800",
                                        "shadow-[0_3px_6px_rgba(79,70,229,0.25)]",
                                        "hover:shadow-[0_5px_10px_rgba(79,70,229,0.35)]",
                                        "transition-all",
                                        "duration-100",
                                        "transform",
                                        "hover:-translate-y-0.5",
                                        "active:translate-y-0",
                                        "active:border-b-0",
                                        "active:mt-[2px]",
                                        "whitespace-nowrap",
                                    ].join(" ")}
                                >
                                    <i
                                        className={[
                                            "fas",
                                            "fa-external-link-alt",
                                            "text-[10px]",
                                        ].join(" ")}
                                    ></i>
                                    <span>Visit Site</span>
                                </a>
                            )}
                        </div>
                    </div>
                </header>

                {/* CASE STUDY CONTENT GRID */}
                <main
                    className={[
                        "grid",
                        "grid-cols-1",
                        "md:grid-cols-3",
                        "gap-6",
                    ].join(" ")}
                >
                    {/* LEFT COLUMN: METADATA, TECH STACK, KEY FEATURES */}
                    <div className={["space-y-6"].join(" ")}>
                        {/* PROJECT OVERVIEW CARD */}
                        <div
                            className={[
                                "rounded-xl",
                                "border",
                                "border-slate-200/60",
                                "dark:border-slate-800/80",
                                "bg-white/60",
                                "dark:bg-slate-900/40",
                                "p-5",
                                "space-y-4",
                                "shadow-sm",
                            ].join(" ")}
                        >
                            <h2
                                className={[
                                    "text-xs",
                                    "font-bold",
                                    "uppercase",
                                    "tracking-wider",
                                    "text-slate-400",
                                ].join(" ")}
                            >
                                Project Overview
                            </h2>
                            <div
                                className={[
                                    "divide-y",
                                    "divide-slate-100",
                                    "dark:divide-slate-800/80",
                                ].join(" ")}
                            >
                                {project.my_role && (
                                    <div
                                        className={[
                                            "py-2.5",
                                            "flex",
                                            "items-start",
                                            "justify-between",
                                            "text-xs",
                                            "md:text-sm",
                                        ].join(" ")}
                                    >
                                        <span
                                            className={[
                                                "font-semibold",
                                                "text-slate-500",
                                                "dark:text-slate-400",
                                            ].join(" ")}
                                        >
                                            My Role
                                        </span>
                                        <span
                                            className={[
                                                "font-bold",
                                                "text-slate-900",
                                                "dark:text-white",
                                                "text-right",
                                                "max-w-[150px]",
                                            ].join(" ")}
                                        >
                                            {project.my_role}
                                        </span>
                                    </div>
                                )}
                                {Object.entries(project.overview || {}).map(
                                    ([key, value]) => (
                                        <div
                                            key={key}
                                            className={[
                                                "py-2.5",
                                                "flex",
                                                "items-center",
                                                "justify-between",
                                                "text-xs",
                                                "md:text-sm",
                                            ].join(" ")}
                                        >
                                            <span
                                                className={[
                                                    "font-semibold",
                                                    "text-slate-500",
                                                    "dark:text-slate-400",
                                                ].join(" ")}
                                            >
                                                {key}
                                            </span>
                                            <span
                                                className={[
                                                    "font-bold",
                                                    "text-slate-900",
                                                    "dark:text-white",
                                                    "text-right",
                                                ].join(" ")}
                                            >
                                                {value}
                                            </span>
                                        </div>
                                    ),
                                )}
                            </div>
                        </div>

                        {/* TECH STACK CARD */}
                        <div
                            className={[
                                "rounded-xl",
                                "border",
                                "border-slate-200/60",
                                "dark:border-slate-800/80",
                                "bg-white/60",
                                "dark:bg-slate-900/40",
                                "p-5",
                                "space-y-4",
                                "shadow-sm",
                            ].join(" ")}
                        >
                            <h2
                                className={[
                                    "text-xs",
                                    "font-bold",
                                    "uppercase",
                                    "tracking-wider",
                                    "text-slate-400",
                                ].join(" ")}
                            >
                                Tech Used
                            </h2>
                            <div
                                className={[
                                    "grid",
                                    "grid-cols-2",
                                    "gap-2",
                                ].join(" ")}
                            >
                                {project.technologies.map((tech, i) => (
                                    <div
                                        key={i}
                                        className={[
                                            "flex",
                                            "items-center",
                                            "gap-2",
                                            "p-2",
                                            "rounded-lg",
                                            "bg-slate-50",
                                            "dark:bg-slate-900",
                                            "border",
                                            "border-slate-150",
                                            "dark:border-slate-800/80",
                                        ].join(" ")}
                                    >
                                        <i
                                            className={[
                                                getTechIcon(tech),
                                                "text-sm",
                                                "shrink-0",
                                            ].join(" ")}
                                        ></i>
                                        <span
                                            className={[
                                                "text-[11px]",
                                                "md:text-xs",
                                                "font-bold",
                                                "text-slate-800",
                                                "dark:text-slate-200",
                                                "truncate",
                                            ].join(" ")}
                                        >
                                            {tech}
                                        </span>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* KEY FEATURES CARD */}
                        {project.key_features && (
                            <div
                                className={[
                                    "rounded-xl",
                                    "border",
                                    "border-slate-200/60",
                                    "dark:border-slate-800/80",
                                    "bg-white/60",
                                    "dark:bg-slate-900/40",
                                    "p-5",
                                    "space-y-4",
                                    "shadow-sm",
                                ].join(" ")}
                            >
                                <h2
                                    className={[
                                        "text-xs",
                                        "font-bold",
                                        "uppercase",
                                        "tracking-wider",
                                        "text-slate-400",
                                    ].join(" ")}
                                >
                                    Key Features
                                </h2>
                                <div className={["space-y-3"].join(" ")}>
                                    {project.key_features.map((feat, i) => (
                                        <div
                                            key={i}
                                            className={[
                                                "flex",
                                                "items-start",
                                                "gap-2.5",
                                            ].join(" ")}
                                        >
                                            <i
                                                className={[
                                                    feat.icon ||
                                                        "fas fa-check-circle",
                                                    "text-indigo-500",
                                                    "mt-0.5",
                                                    "text-xs",
                                                    "shrink-0",
                                                ].join(" ")}
                                            ></i>
                                            <div>
                                                <h3
                                                    className={[
                                                        "text-xs",
                                                        "font-bold",
                                                        "text-slate-900",
                                                        "dark:text-white",
                                                    ].join(" ")}
                                                >
                                                    {feat.title}
                                                </h3>
                                                <p
                                                    className={[
                                                        "text-[10px]",
                                                        "leading-relaxed",
                                                        "text-slate-500",
                                                        "dark:text-slate-400",
                                                    ].join(" ")}
                                                >
                                                    {feat.text}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>

                    {/* RIGHT COLUMN: OBJECTIVES & INTERACTIVE SHOWCASE */}
                    <div className={["md:col-span-2", "space-y-6"].join(" ")}>
                        {/* PROBLEM STATEMENT */}
                        {project.problem && (
                            <div
                                className={[
                                    "rounded-xl",
                                    "border",
                                    "border-slate-200/60",
                                    "dark:border-slate-800/80",
                                    "bg-white/60",
                                    "dark:bg-slate-900/40",
                                    "p-6",
                                    "space-y-3",
                                    "shadow-sm",
                                ].join(" ")}
                            >
                                <h2
                                    className={[
                                        "text-lg",
                                        "font-bold",
                                        "text-slate-900",
                                        "dark:text-white",
                                        "display-font",
                                        "flex",
                                        "items-center",
                                        "gap-2",
                                    ].join(" ")}
                                >
                                    <i
                                        className={[
                                            "fas",
                                            "fa-exclamation-circle",
                                            "text-indigo-500",
                                        ].join(" ")}
                                    ></i>
                                    <span>Problem Statement</span>
                                </h2>
                                <p
                                    className={[
                                        "text-xs",
                                        "md:text-sm",
                                        "leading-relaxed",
                                        "text-slate-750",
                                        "dark:text-slate-300",
                                    ].join(" ")}
                                >
                                    {project.problem}
                                </p>
                            </div>
                        )}

                        {/* SYSTEM OBJECTIVES */}
                        {project.objectives && (
                            <div
                                className={[
                                    "rounded-xl",
                                    "border",
                                    "border-slate-200/60",
                                    "dark:border-slate-800/80",
                                    "bg-white/60",
                                    "dark:bg-slate-900/40",
                                    "p-6",
                                    "space-y-4",
                                    "shadow-sm",
                                ].join(" ")}
                            >
                                <h2
                                    className={[
                                        "text-lg",
                                        "font-bold",
                                        "text-slate-900",
                                        "dark:text-white",
                                        "display-font",
                                    ].join(" ")}
                                >
                                    System Objectives
                                </h2>
                                <div
                                    className={[
                                        "grid",
                                        "grid-cols-1",
                                        "sm:grid-cols-3",
                                        "gap-3",
                                    ].join(" ")}
                                >
                                    {project.objectives.map((obj, i) => {
                                        // Dynamic colors for objectives cards
                                        const bgColors = [
                                            "bg-indigo-50/50 dark:bg-indigo-950/20 border-indigo-100 dark:border-indigo-900/50",
                                            "bg-emerald-50/50 dark:bg-emerald-950/20 border-emerald-100 dark:border-emerald-900/50",
                                            "bg-purple-50/50 dark:bg-purple-950/20 border-purple-100 dark:border-purple-900/50",
                                        ];
                                        const textColors = [
                                            "text-indigo-850 dark:text-indigo-205",
                                            "text-emerald-850 dark:text-emerald-205",
                                            "text-purple-850 dark:text-purple-205",
                                        ];
                                        return (
                                            <div
                                                key={i}
                                                className={[
                                                    "p-4",
                                                    "rounded-xl",
                                                    "border",
                                                    bgColors[i % 3],
                                                    "space-y-1.5",
                                                ].join(" ")}
                                            >
                                                <h3
                                                    className={[
                                                        "text-xs",
                                                        "md:text-sm",
                                                        "font-bold",
                                                        textColors[i % 3],
                                                    ].join(" ")}
                                                >
                                                    {obj.title}
                                                </h3>
                                                <p
                                                    className={[
                                                        "text-[11px]",
                                                        "leading-relaxed",
                                                        "text-slate-600",
                                                        "dark:text-slate-400",
                                                    ].join(" ")}
                                                >
                                                    {obj.text}
                                                </p>
                                            </div>
                                        );
                                    })}
                                </div>
                            </div>
                        )}

                        {/* DYNAMIC SHOWCASE SECTIONS */}
                        {project.showcase_sections &&
                            project.showcase_sections.length > 0 && (
                                <div className={["space-y-6"].join(" ")}>
                                    {project.showcase_sections.map(
                                        (sect, sIdx) => (
                                            <div
                                                key={sIdx}
                                                className={[
                                                    "rounded-xl",
                                                    "border",
                                                    "border-slate-200/60",
                                                    "dark:border-slate-800/80",
                                                    "bg-white/60",
                                                    "dark:bg-slate-900/40",
                                                    "p-6",
                                                    "space-y-6",
                                                    "shadow-sm",
                                                ].join(" ")}
                                            >
                                                <div
                                                    className={[
                                                        "flex",
                                                        "items-center",
                                                        "gap-2",
                                                    ].join(" ")}
                                                >
                                                    <div
                                                        className={[
                                                            "w-1.5",
                                                            "h-6",
                                                            "bg-indigo-500",
                                                            "rounded-full",
                                                        ].join(" ")}
                                                    ></div>
                                                    <h2
                                                        className={[
                                                            "text-base",
                                                            "md:text-lg",
                                                            "font-bold",
                                                            "text-slate-900",
                                                            "dark:text-white",
                                                            "display-font",
                                                        ].join(" ")}
                                                    >
                                                        {sect.title}
                                                    </h2>
                                                </div>

                                                <div
                                                    className={[
                                                        "relative",
                                                        "aspect-[16/10]",
                                                        "w-full",
                                                        "overflow-hidden",
                                                        "rounded-xl",
                                                        "border",
                                                        "border-slate-200",
                                                        "dark:border-slate-800",
                                                        "bg-slate-100",
                                                        "dark:bg-slate-950",
                                                        "shadow-md",
                                                        "cursor-pointer",
                                                    ].join(" ")}
                                                    onClick={() =>
                                                        setSelectedShowcaseImage(
                                                            sect.image,
                                                        )
                                                    }
                                                >
                                                    <img
                                                        src={
                                                            sect.image.startsWith(
                                                                "/",
                                                            )
                                                                ? sect.image
                                                                : `/${sect.image}`
                                                        }
                                                        alt={sect.title}
                                                        className={[
                                                            "w-full",
                                                            "h-full",
                                                            "object-cover",
                                                            "transition-transform",
                                                            "duration-700",
                                                            "hover:scale-105",
                                                        ].join(" ")}
                                                        onError={(e) => {
                                                            e.target.style.display =
                                                                "none";
                                                            if (
                                                                e.target
                                                                    .parentElement
                                                                    .nextSibling
                                                            ) {
                                                                e.target.parentElement.nextSibling.style.display =
                                                                    "flex";
                                                            }
                                                        }}
                                                    />
                                                    <div
                                                        className={[
                                                            "absolute",
                                                            "inset-0",
                                                            "hidden",
                                                            "flex-col",
                                                            "items-center",
                                                            "justify-center",
                                                            "bg-gradient-to-br",
                                                            "from-indigo-500/10",
                                                            "to-purple-500/10",
                                                            "text-slate-400",
                                                            "dark:text-slate-600",
                                                            "pointer-events-none",
                                                        ].join(" ")}
                                                    >
                                                        <i
                                                            className={[
                                                                "fas",
                                                                "fa-network-wired",
                                                                "text-4xl",
                                                                "mb-2",
                                                                "text-indigo-500/40",
                                                            ].join(" ")}
                                                        ></i>
                                                        <span
                                                            className={[
                                                                "text-xs",
                                                                "font-semibold",
                                                                "uppercase",
                                                                "tracking-wider",
                                                            ].join(" ")}
                                                        >
                                                            {sect.title}
                                                        </span>
                                                    </div>
                                                </div>

                                                {sect.features &&
                                                    sect.features.length >
                                                        0 && (
                                                        <div
                                                            className={[
                                                                "grid",
                                                                "grid-cols-1",
                                                                "sm:grid-cols-2",
                                                                "gap-4",
                                                                "pt-4",
                                                                "border-t",
                                                                "border-slate-100",
                                                                "dark:border-slate-800/85",
                                                            ].join(" ")}
                                                        >
                                                            {sect.features.map(
                                                                (
                                                                    feat,
                                                                    fIdx,
                                                                ) => (
                                                                    <div
                                                                        key={
                                                                            fIdx
                                                                        }
                                                                        className={[
                                                                            "flex",
                                                                            "items-start",
                                                                            "gap-3",
                                                                            "p-3",
                                                                            "rounded-lg",
                                                                            "bg-slate-50/50",
                                                                            "dark:bg-slate-950/20",
                                                                            "border",
                                                                            "border-slate-100/80",
                                                                            "dark:border-slate-800/50",
                                                                            "hover:border-slate-200",
                                                                            "dark:hover:border-slate-700",
                                                                            "transition-colors",
                                                                        ].join(
                                                                            " ",
                                                                        )}
                                                                    >
                                                                        <span
                                                                            className={[
                                                                                "flex",
                                                                                "items-center",
                                                                                "justify-center",
                                                                                "w-8",
                                                                                "h-8",
                                                                                "rounded-lg",
                                                                                "bg-indigo-50",
                                                                                "dark:bg-indigo-950/50",
                                                                                "text-indigo-500",
                                                                                "shrink-0",
                                                                            ].join(
                                                                                " ",
                                                                            )}
                                                                        >
                                                                            <i
                                                                                className={[
                                                                                    feat.icon ||
                                                                                        "fas fa-check-circle",
                                                                                ].join(
                                                                                    " ",
                                                                                )}
                                                                            ></i>
                                                                        </span>
                                                                        <div
                                                                            className={[
                                                                                "space-y-0.5",
                                                                            ].join(
                                                                                " ",
                                                                            )}
                                                                        >
                                                                            <h4
                                                                                className={[
                                                                                    "text-xs",
                                                                                    "md:text-sm",
                                                                                    "font-bold",
                                                                                    "text-slate-950",
                                                                                    "dark:text-white",
                                                                                    "leading-snug",
                                                                                ].join(
                                                                                    " ",
                                                                                )}
                                                                            >
                                                                                {
                                                                                    feat.title
                                                                                }
                                                                            </h4>
                                                                            <p
                                                                                className={[
                                                                                    "text-[10px]",
                                                                                    "md:text-xs",
                                                                                    "leading-relaxed",
                                                                                    "text-slate-500",
                                                                                    "dark:text-slate-400",
                                                                                ].join(
                                                                                    " ",
                                                                                )}
                                                                            >
                                                                                {
                                                                                    feat.text
                                                                                }
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                ),
                                                            )}
                                                        </div>
                                                    )}
                                            </div>
                                        ),
                                    )}
                                </div>
                            )}

                        {(!project.showcase_sections ||
                            project.showcase_sections.length === 0) && (
                            /* SCREENSHOT & SHOWCASE SECTION FALLBACK */
                            <div
                                className={[
                                    "rounded-xl",
                                    "border",
                                    "border-slate-200/60",
                                    "dark:border-slate-800/80",
                                    "bg-white/60",
                                    "dark:bg-slate-900/40",
                                    "p-6",
                                    "space-y-6",
                                    "shadow-sm",
                                ].join(" ")}
                            >
                                <div className={["space-y-1.5"].join(" ")}>
                                    <h2
                                        className={[
                                            "text-lg",
                                            "font-bold",
                                            "text-slate-900",
                                            "dark:text-white",
                                            "display-font",
                                        ].join(" ")}
                                    >
                                        Application Showcase
                                    </h2>
                                    <p
                                        className={[
                                            "text-xs",
                                            "text-slate-500",
                                            "dark:text-slate-400",
                                        ].join(" ")}
                                    >
                                        Interactive live screen captures and
                                        operational highlights.
                                    </p>
                                </div>

                                <div
                                    className={[
                                        "relative",
                                        "aspect-[16/10]",
                                        "w-full",
                                        "overflow-hidden",
                                        "rounded-xl",
                                        "border",
                                        "border-slate-200",
                                        "dark:border-slate-800",
                                        "bg-slate-100",
                                        "dark:bg-slate-950",
                                        "shadow-md",
                                        "cursor-pointer",
                                    ].join(" ")}
                                    onClick={() =>
                                        setSelectedShowcaseImage(project.image)
                                    }
                                >
                                    <img
                                        src={`/${project.image}`}
                                        alt={project.title}
                                        className={[
                                            "w-full",
                                            "h-full",
                                            "object-cover",
                                            "transition-transform",
                                            "duration-700",
                                            "hover:scale-105",
                                        ].join(" ")}
                                    />
                                </div>
                            </div>
                        )}

                        {/* CHALLENGES & SOLUTION */}
                        {(project.challenges || project.solution) && (
                            <div
                                className={[
                                    "rounded-xl",
                                    "border",
                                    "border-slate-200/60",
                                    "dark:border-slate-800/80",
                                    "bg-white/60",
                                    "dark:bg-slate-900/40",
                                    "p-6",
                                    "space-y-4",
                                    "shadow-sm",
                                ].join(" ")}
                            >
                                <h2
                                    className={[
                                        "text-lg",
                                        "font-bold",
                                        "text-slate-900",
                                        "dark:text-white",
                                        "display-font",
                                    ].join(" ")}
                                >
                                    Challenges & Solution
                                </h2>
                                <div
                                    className={[
                                        "grid",
                                        "grid-cols-1",
                                        "sm:grid-cols-2",
                                        "gap-4",
                                    ].join(" ")}
                                >
                                    {project.challenges && (
                                        <div
                                            className={[
                                                "p-4",
                                                "rounded-xl",
                                                "border",
                                                "border-red-100",
                                                "dark:border-red-950/40",
                                                "bg-red-50/20",
                                                "dark:bg-red-950/10",
                                                "space-y-1.5",
                                            ].join(" ")}
                                        >
                                            <h3
                                                className={[
                                                    "text-xs",
                                                    "md:text-sm",
                                                    "font-bold",
                                                    "text-red-800",
                                                    "dark:text-red-400",
                                                    "flex",
                                                    "items-center",
                                                    "gap-1.5",
                                                ].join(" ")}
                                            >
                                                <i
                                                    className={[
                                                        "fas",
                                                        "fa-tools",
                                                    ].join(" ")}
                                                ></i>{" "}
                                                Key Challenges
                                            </h3>
                                            <p
                                                className={[
                                                    "text-[11px]",
                                                    "md:text-xs",
                                                    "leading-relaxed",
                                                    "text-slate-700",
                                                    "dark:text-slate-350",
                                                ].join(" ")}
                                            >
                                                {project.challenges}
                                            </p>
                                        </div>
                                    )}
                                    {project.solution && (
                                        <div
                                            className={[
                                                "p-4",
                                                "rounded-xl",
                                                "border",
                                                "border-emerald-100",
                                                "dark:border-emerald-950/40",
                                                "bg-emerald-50/20",
                                                "dark:bg-emerald-950/10",
                                                "space-y-1.5",
                                            ].join(" ")}
                                        >
                                            <h3
                                                className={[
                                                    "text-xs",
                                                    "md:text-sm",
                                                    "font-bold",
                                                    "text-emerald-800",
                                                    "dark:text-emerald-400",
                                                    "flex",
                                                    "items-center",
                                                    "gap-1.5",
                                                ].join(" ")}
                                            >
                                                <i
                                                    className={[
                                                        "fas",
                                                        "fa-lightbulb",
                                                    ].join(" ")}
                                                ></i>{" "}
                                                Applied Solution
                                            </h3>
                                            <p
                                                className={[
                                                    "text-[11px]",
                                                    "md:text-xs",
                                                    "leading-relaxed",
                                                    "text-slate-700",
                                                    "dark:text-slate-350",
                                                ].join(" ")}
                                            >
                                                {project.solution}
                                            </p>
                                        </div>
                                    )}
                                </div>
                            </div>
                        )}

                        {/* DEVELOPMENT PROCESS */}
                        {project.development_process && (
                            <div
                                className={[
                                    "rounded-xl",
                                    "border",
                                    "border-slate-200/60",
                                    "dark:border-slate-800/80",
                                    "bg-white/60",
                                    "dark:bg-slate-900/40",
                                    "p-6",
                                    "space-y-4",
                                    "shadow-sm",
                                ].join(" ")}
                            >
                                <h2
                                    className={[
                                        "text-lg",
                                        "font-bold",
                                        "text-slate-900",
                                        "dark:text-white",
                                        "display-font",
                                    ].join(" ")}
                                >
                                    Development Process
                                </h2>
                                <div
                                    className={[
                                        "relative",
                                        "border-l-2",
                                        "border-indigo-500/20",
                                        "dark:border-indigo-500/10",
                                        "pl-5",
                                        "ml-2.5",
                                        "space-y-5",
                                    ].join(" ")}
                                >
                                    {project.development_process.map(
                                        (step, i) => (
                                            <div
                                                key={i}
                                                className={["relative"].join(
                                                    " ",
                                                )}
                                            >
                                                <div
                                                    className={[
                                                        "absolute",
                                                        "-left-[27px]",
                                                        "top-1",
                                                        "w-3",
                                                        "h-3",
                                                        "rounded-full",
                                                        "bg-indigo-500",
                                                        "border-2",
                                                        "border-white",
                                                        "dark:border-slate-950",
                                                    ].join(" ")}
                                                ></div>
                                                <span
                                                    className={[
                                                        "inline-block",
                                                        "font-mono",
                                                        "text-[9px]",
                                                        "px-1.5",
                                                        "py-0.5",
                                                        "border",
                                                        "border-indigo-150",
                                                        "dark:border-indigo-900/50",
                                                        "bg-indigo-50/50",
                                                        "dark:bg-indigo-950/30",
                                                        "text-indigo-700",
                                                        "dark:text-indigo-300",
                                                        "font-bold",
                                                        "rounded",
                                                        "mb-1",
                                                    ].join(" ")}
                                                >
                                                    Step 0{i + 1}
                                                </span>
                                                <div
                                                    className={[
                                                        "text-xs",
                                                        "md:text-sm",
                                                        "font-bold",
                                                        "text-slate-800",
                                                        "dark:text-slate-200",
                                                    ].join(" ")}
                                                >
                                                    {step}
                                                </div>
                                            </div>
                                        ),
                                    )}
                                </div>
                            </div>
                        )}

                        {/* BOTTOM GRID FOR OUTCOMES */}
                        {(project.results ||
                            project.lessons_learned ||
                            project.future_improvements) && (
                            <div className={["space-y-6"].join(" ")}>
                                <div
                                    className={[
                                        "grid",
                                        "grid-cols-1",
                                        "sm:grid-cols-2",
                                        "gap-6",
                                    ].join(" ")}
                                >
                                    {/* LESSONS LEARNED */}
                                    {project.lessons_learned && (
                                        <div
                                            className={[
                                                "rounded-xl",
                                                "border",
                                                "border-slate-200/60",
                                                "dark:border-slate-800/80",
                                                "bg-white/60",
                                                "dark:bg-slate-900/40",
                                                "p-5",
                                                "space-y-3.5",
                                                "shadow-sm",
                                            ].join(" ")}
                                        >
                                            <h3
                                                className={[
                                                    "text-xs",
                                                    "font-bold",
                                                    "uppercase",
                                                    "tracking-wider",
                                                    "text-slate-400",
                                                    "flex",
                                                    "items-center",
                                                    "gap-1.5",
                                                ].join(" ")}
                                            >
                                                <i
                                                    className={[
                                                        "fas",
                                                        "fa-graduation-cap",
                                                        "text-indigo-500",
                                                    ].join(" ")}
                                                ></i>{" "}
                                                Lessons Learned
                                            </h3>
                                            <ul
                                                className={["space-y-2"].join(
                                                    " ",
                                                )}
                                            >
                                                {project.lessons_learned.map(
                                                    (les, i) => (
                                                        <li
                                                            key={i}
                                                            className={[
                                                                "text-xs",
                                                                "leading-relaxed",
                                                                "text-slate-700",
                                                                "dark:text-slate-300",
                                                                "flex",
                                                                "items-start",
                                                                "gap-2",
                                                            ].join(" ")}
                                                        >
                                                            <i
                                                                className={[
                                                                    "fas",
                                                                    "fa-star",
                                                                    "text-[10px]",
                                                                    "text-indigo-500",
                                                                    "mt-1",
                                                                    "shrink-0",
                                                                ].join(" ")}
                                                            ></i>
                                                            <span>{les}</span>
                                                        </li>
                                                    ),
                                                )}
                                            </ul>
                                        </div>
                                    )}

                                    {/* FUTURE IMPROVEMENTS */}
                                    {project.future_improvements && (
                                        <div
                                            className={[
                                                "rounded-xl",
                                                "border",
                                                "border-slate-200/60",
                                                "dark:border-slate-800/80",
                                                "bg-white/60",
                                                "dark:bg-slate-900/40",
                                                "p-5",
                                                "space-y-3.5",
                                                "shadow-sm",
                                            ].join(" ")}
                                        >
                                            <h3
                                                className={[
                                                    "text-xs",
                                                    "font-bold",
                                                    "uppercase",
                                                    "tracking-wider",
                                                    "text-slate-400",
                                                    "flex",
                                                    "items-center",
                                                    "gap-1.5",
                                                ].join(" ")}
                                            >
                                                <i
                                                    className={[
                                                        "fas",
                                                        "fa-arrow-alt-circle-right",
                                                        "text-purple-500",
                                                    ].join(" ")}
                                                ></i>{" "}
                                                Future Plans
                                            </h3>
                                            <ul
                                                className={["space-y-2"].join(
                                                    " ",
                                                )}
                                            >
                                                {project.future_improvements.map(
                                                    (imp, i) => (
                                                        <li
                                                            key={i}
                                                            className={[
                                                                "text-xs",
                                                                "leading-relaxed",
                                                                "text-slate-700",
                                                                "dark:text-slate-300",
                                                                "flex",
                                                                "items-start",
                                                                "gap-2",
                                                            ].join(" ")}
                                                        >
                                                            <i
                                                                className={[
                                                                    "fas",
                                                                    "fa-chevron-right",
                                                                    "text-[8px]",
                                                                    "text-purple-500",
                                                                    "mt-1.5",
                                                                    "shrink-0",
                                                                ].join(" ")}
                                                            ></i>
                                                            <span>{imp}</span>
                                                        </li>
                                                    ),
                                                )}
                                            </ul>
                                        </div>
                                    )}
                                </div>

                                {/* RESULTS */}
                                {project.results && (
                                    <div
                                        className={[
                                            "rounded-xl",
                                            "border",
                                            "border-slate-200/60",
                                            "dark:border-slate-800/80",
                                            "bg-white/60",
                                            "dark:bg-slate-900/40",
                                            "p-5",
                                            "space-y-3.5",
                                            "shadow-sm",
                                        ].join(" ")}
                                    >
                                        <h3
                                            className={[
                                                "text-xs",
                                                "font-bold",
                                                "uppercase",
                                                "tracking-wider",
                                                "text-slate-400",
                                                "flex",
                                                "items-center",
                                                "gap-1.5",
                                            ].join(" ")}
                                        >
                                            <i
                                                className={[
                                                    "fas",
                                                    "fa-chart-line",
                                                    "text-emerald-500",
                                                ].join(" ")}
                                            ></i>{" "}
                                            Results
                                        </h3>
                                        <ul className={["space-y-2"].join(" ")}>
                                            {project.results.map((res, i) => (
                                                <li
                                                    key={i}
                                                    className={[
                                                        "text-xs",
                                                        "leading-relaxed",
                                                        "text-slate-700",
                                                        "dark:text-slate-300",
                                                        "flex",
                                                        "items-start",
                                                        "gap-2",
                                                    ].join(" ")}
                                                >
                                                    <i
                                                        className={[
                                                            "fas",
                                                            "fa-check-circle",
                                                            "text-[10px]",
                                                            "text-emerald-500",
                                                            "mt-1",
                                                            "shrink-0",
                                                        ].join(" ")}
                                                    ></i>
                                                    <span>{res}</span>
                                                </li>
                                            ))}
                                        </ul>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </main>

                {/* FOOTER */}
                <footer
                    className={["text-center"].join(" ")}
                    style={{ marginTop: "8rem", paddingBottom: "2rem" }}
                >
                    <p className={["text-xs", "text-slate-400"].join(" ")}>
                        &copy; {currentYear} {profile.name}. All rights
                        reserved.
                    </p>
                </footer>
            </div>

            {/* FULLSCREEN IMAGE MODAL */}
            {selectedShowcaseImage && (
                <div
                    className={[
                        "fixed",
                        "inset-0",
                        "z-50",
                        "flex",
                        "items-center",
                        "justify-center",
                        "bg-black/90",
                        "p-4",
                        "sm:p-8",
                        "backdrop-blur-sm",
                        "cursor-zoom-out",
                    ].join(" ")}
                    onClick={() => setSelectedShowcaseImage(null)}
                >
                    <img
                        src={
                            selectedShowcaseImage.startsWith("http") ||
                            selectedShowcaseImage.startsWith("/")
                                ? selectedShowcaseImage
                                : `/${selectedShowcaseImage}`
                        }
                        alt={project.title}
                        className={[
                            "max-w-full",
                            "max-h-full",
                            "object-contain",
                            "rounded-lg",
                            "shadow-2xl",
                        ].join(" ")}
                    />
                </div>
            )}
        </>
    );
}
